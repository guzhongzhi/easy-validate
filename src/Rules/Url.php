<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/23
 * Time: 0:01
 */

namespace Guz\EasyValidate\Rules;


class Url extends Rule
{
    const CODE = "url";
    
    protected function _validate()
    {
        $value = $this->getValue();
        if(filter_var($value, FILTER_VALIDATE_URL) === false) {
            $this->errors[] = $this->generateError();
        }
    }
}
