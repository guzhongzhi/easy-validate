<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/23
 * Time: 0:02
 */

namespace Guz\EasyValidate\Rules;

/**
 * [
 * "regex"=>"",
 * "match"=>true|false, //if match is true, the value must match the regex, if the match is false, the value must not match the value
 * ]
 * Class Regex
 *
 * @package Guz\EasyValidate\Rules
 */
class Regex extends Rule
{
    protected function _validate()
    {
        $data = isset($this->data[$this->fieldName]) ? $this->data[$this->fieldName] : "";
        $regex =  isset($this->config["regex"]) ? $this->config["regex"] : "";
        if(!$regex) {
            $this->errors [] = $this->generateError("no regex rule");
            return false;
        }
        $match = isset($this->config["match"]) ? $this->config["match"] : true;
        $v = preg_match($regex, $data);
        return boolval($v) === $match;
    }
}
