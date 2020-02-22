<?php
namespace Guz\EasyValidate\Rules;

class Required extends Rule {
    
    protected function _validate() {
        $fieldName = $this->fieldName;
        $data = $this->data;
        $condition = $this->config;
        
        if (!isset($data[$fieldName]) || $data[$fieldName] == "") {
            $this->errors[] = $this->generateError($this->getErrorMessage());
        }
    }
    
    protected function getErrorMessage() {
        if(isset($this->config["message"]) && $this->config["message"]) {
            return sprintf($this->config["message"],$this->label);
        }
        return sprintf("%s is required",$this->label);
    }
}