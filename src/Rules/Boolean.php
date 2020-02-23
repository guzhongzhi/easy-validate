<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/23
 * Time: 0:24
 */

namespace Guz\EasyValidate\Rules;


class Boolean extends OneOf
{
    const CODE = "boolean";
    
    protected function _validate()
    {
        $this->config["data"] = [true,false];
        return parent::_validate();
    }
}
