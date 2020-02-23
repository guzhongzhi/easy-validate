<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/23
 * Time: 16:46
 */

namespace Guz\EasyValidate\Rules;


class Ip extends Rule
{
    const CODE = "ip";
    
    protected function _validate()
    {
        $value = $this->getValue();
        if(filter_var($value, FILTER_VALIDATE_IP) === false) {
            $this->errors[] = $this->generateError();
        }
        return true;
    }
}
