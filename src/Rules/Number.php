<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/23
 * Time: 0:01
 */

namespace Guz\EasyValidate\Rules;

/**
 * [
 * min=>,
 * max=>,
 * includeMin=>true,　是否包含最小值　
 * includeMax=>false, 是否包含最大值
 * decimal=>2,  小数位数,
 * ]
 * Class Number
 *
 * @package Guz\EasyValidate\Rules
 */
class Number extends Rule
{
    const CODE = "number";
    
    protected function _validate()
    {
        $value = $this->getValue();
        if(isset($this->config["min"])) {
            $min = $this->config["min"];
            $includeMin = isset($this->config["includeMin"]) ? $this->config["includeMin"] : false;
            $res = true;
            if($includeMin) {
                $res = $value >= $min;
            } else {
                $res = $value > $min;
            }
            if(!$res) {
                $this->generateError(sprintf("%s must greater than %s",$this->label,$min));
                return;
            }
        }
        if(isset($this->config["max"])) {
            $max = $this->config["max"];
            $includeMax = isset($this->config["includeMax"]) ? $this->config["includeMax"] : false;
            $res = true;
            if($includeMax) {
                $res = $value <= $max;
            } else {
                $res = $value < $max;
            }
            if(!$res) {
                $this->generateError();
                return;
            }
        }
        $decimal = isset($this->config["decimal"]) ? $this->config["decimal"] : null;
        if($decimal === null) {
            return;
        }
        $regex = '/\.[0-9]{'.$decimal.'}$/is';
        if(preg_match($regex,$value) === false) {
            $this->generateError();
        }
    }
}
