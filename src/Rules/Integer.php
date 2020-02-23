<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/23
 * Time: 0:11
 */

namespace Guz\EasyValidate\Rules;

/**
 * Class Integer
 *
 * [
 * min=>
 * max=>
 *
 * ]
 *
 * @package Guz\EasyValidate\Rules
 */
class Integer extends Number
{
    const CODE = "integer";
    
    protected function _validate()
    {
        $value = $this->getValue();
        if(!is_int($value)) {
            $this->errors[] = $this->generateError();
            return;
        }
        parent::_validate();
        
    }
}
