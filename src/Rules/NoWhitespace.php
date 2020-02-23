<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/23
 * Time: 0:26
 */

namespace Guz\EasyValidate\Rules;


class NoWhitespace extends Rule
{
    const CODE = "noWhitespace";
    
    protected function _validate()
    {
        $value = $this->getValue();
        $regex = '/\s+/is';
        if(preg_match($regex, $value) === false) {
            $this->errors[] = $this->generateError();
        }
    }
}
