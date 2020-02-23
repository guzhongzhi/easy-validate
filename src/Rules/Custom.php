<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/23
 * Time: 0:26
 */

namespace Guz\EasyValidate\Rules;


/**
 * [
 * callback=>function($rule,$fieldName,$data,$config) {}
 * ]
 * Class Custom
 *
 * @package Guz\EasyValidate\Rules
 */
class Custom extends Rule
{
    const CODE = "custom";
    
    protected function _validate()
    {
        $callback = isset($this->config["callback"]) ? $this->config["callback"] : null;
        $v = true;
        if($callback) {
            $v = call_user_func_array($callback, [$this,$this->fieldName,$this->data,$this->config]);
        }
        if(!$v) {
            $this->errors[] = $this->getErrorMessage();
        }
    }
}
