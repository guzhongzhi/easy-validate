<?php
namespace Guz\EasyValidate\Rules;

/**
 * [
 * data=>[1,2,3]
 * ]
 * Class OneOf
 * @package Guz\EasyValidate\Rules
 */
class OneOf extends Rule {
    
    protected function _validate() {
        $data = $this->data;
        $fieldName = $this->fieldName;
        
        $values = $this->getAllowedValues();
        $value = isset($data[$fieldName]) ? $data[$fieldName] : [];
        if (!is_array($value)) {
            $value = explode(",", $value);
        }
        foreach ($value as $v) {
            if (!in_array($v, $values)) {
                $this->errors[] = $this->generateError();
            }
        }
    }
    
    /**
     * @return array
     */
    protected function getAllowedValues() {
        $condition = $this->condition;
        $values = isset($condition["data"]) ? $condition["data"] : [];
        
        if (!is_array($values)) {
            $values = explode(",", $values);
        }
        return $values;
    }
    
    /**
     * @return string
     */
    protected function getErrorMessage() {
        if(isset($this->config["message"]) && $this->config["message"]) {
            return sprintf($this->config["message"],$this->label);
        }
        return sprintf("%s is not one of '%s'",$this->label, implode(",", $this->getAllowedValues()));
    }
}