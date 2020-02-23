<?php
namespace Guz\EasyValidate;

/**
 * Class Validate
 *
 * @package Guz\EasyValidate
 */
class Validate
{
    const RULE_DEFAULT = "required";
    
    /**
     * @var array
     */
    protected $errors = [];
    
    /**
     * @var array
     */
    protected $data = [];
    
    /**
     * @var array
     */
    protected $rules = [];
    
    /**
     * Validate constructor.
     * @param array $data
     * @param array $rules
     */
    public function __construct($data = [], $rules = [])
    {
        $this->data = $data;
        $this->rules = $rules;
    }
    
    /**
     * @param  $conditions
     * @return array
     */
    protected function formatConditions($conditions)
    {
        if (!is_array($conditions)) {
            $conditions = [
                [
                    "rule"=>self::RULE_DEFAULT,
                    "message"=>$conditions,
                ]
            ];
        }
        return $conditions;
    }
    
    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
    
    /**
     * @param  $source
     * @param  $rules
     * @return bool
     */
    public function validate($source = [],$rules = [])
    {
        if(!empty($source)) {
            $source = $this->data;
        }
        if(empty($rules)) {
            $rules = $this->rules;
        }
        $this->errors = [];
        foreach ($rules as $fieldName => $conditions) {
            $data = $source;
            $temp = explode(".", $fieldName);
            $isValidated = false;
            if (count($temp) > 1) {
                $fieldName = array_pop($temp);
                foreach ($temp as $subFieldIndex => $subFieldName) {
                    if ($subFieldName == "$") {
                        $keys = array_slice($temp, $subFieldIndex+1);
                        $keys[] = $fieldName;
                        foreach ($data as $v) {
                            $path = implode(".", $keys);
                            $this->validateItem($v, [$path=>$conditions]);
                        }
                        $isValidated = true;
                        break;
                    } else {
                        $data = isset($data[$subFieldName]) ? $data[$subFieldName] : [];
                    }
                }
            }
            //如果是数组类型的子对像验证，已经验证过了，则不再曳光弹验证
            if ($isValidated) {
                continue;
            }
            $conditions = $this->formatConditions($conditions);
            $this->validateField($fieldName, $conditions, $data);
        }
        return count($this->errors) == 0 ;
    }
    
    /**
     * @param $fieldName
     * @param $conditions
     * @param $data
     */
    protected function validateField($fieldName,$conditions,$data)
    {
        $label = $fieldName;
        if(isset($conditions["label"])) {
            $label = $conditions["label"];
            unset($conditions["label"]);
        }
        $rules = $conditions;
        if(isset($conditions["rules"])) {
            $rules = $conditions["rules"];
        }
        foreach ($rules as $condition) {
            if (!isset($condition["rule"])) {
                $condition["rule"] = self::RULE_DEFAULT;
            }
            $className = __NAMESPACE__ . "\\Rules\\".ucfirst($condition["rule"]);
            $rule = new $className($fieldName, $condition, $data);
            $rule->setLabel($label);
            try {
                if($rule->validate() === false) {
                    $this->errors[$fieldName] = $rule->getErrors();
                    break;
                }
            }catch(\Exception $ex) {
                $this->errors[$fieldName] = array_merge($rule->getErrors(), $ex);
                break;
            }
        }
    }
    
}