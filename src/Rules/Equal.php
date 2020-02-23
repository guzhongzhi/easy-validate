<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/23
 * Time: 0:14
 */

namespace Guz\EasyValidate\Rules;

/**
 * [
 * targetFieldName=>""
 * ]
 * Class Equal
 *
 * @package Guz\EasyValidate\Rules
 */
class Equal extends Rule
{
    const CODE = "equal";
    
    protected function _validate()
    {
        $value = $this->getValue();
        $targetField = isset($this->config["targetFieldName"]) ? $this->config["targetFieldName"] :"";
        $value2 = $this->getValue($targetField);
        if($value != $value2) {
            $this->generateError();
        }
    }
    
}
