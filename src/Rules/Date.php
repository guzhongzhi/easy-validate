<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/23
 * Time: 0:06
 */

namespace Guz\EasyValidate\Rules;

/**
 * based on php strptime
 * [
 * format=>"",
 * ]
 * Class Date
 *
 * @package Guz\EasyValidate\Rules
 */
class Date extends Rule
{
    const CODE = "date";
    
    protected function _validate()
    {
        $value = $this->getValue();
        $format = $this->config["format"];
        $strf = strptime($value, $format);
        if($strf === false) {
            $this->errors[] = $this->generateError();
        }
    }
}
