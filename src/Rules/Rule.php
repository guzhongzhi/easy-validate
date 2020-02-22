<?php
namespace Guz\EasyValidate\Rules;

abstract class Rule
{
    /**
     * @var array
     */
    protected $config;
    
    /**
     * @var array|object
     */
    protected $data;
    /**
     * @var array
     */
    protected $errors = [];
    /**
     * @var string
     */
    protected $label = "";
    /**
     * @var string
     */
    protected $fieldName = "";
    
    /**
     * Rule constructor.
     *
     * @param string       $fieldName
     * @param array        $config
     * @param array|object $data
     */
    public function __construct($fieldName, $config, $data)
    {
        if (!isset($config["message"])) {
            $config["message"] = "";
        }
        
        $this->fieldName = $fieldName;
        $this->config = $config;
        $this->data = $data;
        $this->label = $fieldName;
    }
    
    /**
     * @param  string $v
     * @return $this
     */
    public function setLabel($v)
    {
        $this->label = $v;
        return $this;
    }
    
    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
    
    /**
     * @return bool
     * @throws \Exception
     */
    public final function validate()
    {
        $this->errors = [];
        $this->_validate();
        if(count($this->errors)) { 
            return false;
        }
        return true;
    }
    
    /**
     * @return mixed|string
     */
    protected function getErrorMessage()
    {
        if(isset($this->config["message"]) && $this->config["message"]) {
            return $this->config["message"];
        }
        return sprintf("%s validate failed", $this->label);
    }
    
    /**
     * @param  string $message
     * @return \Exception
     */
    protected function generateError($message = "")
    {
        if($message == "") {
            $message = $this->getErrorMessage();
        }
        
        $code = isset($this->config["code"]) ? $this->config["code"] : 0;
        return new \Exception($message, $code);
    }
    
    /**
     * @throws \Exception
     */
    protected function _validate()
    {
        throw new \Exception("Not implemented");
    }
}