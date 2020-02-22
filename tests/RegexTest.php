<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/23
 * Time: 0:39
 */

namespace Guz\EasyValidate\Tests;


require_once 'vendor/autoload.php';

class RegexTest extends \PHPUnit_Framework_TestCase
{
    function testRegexMatch()
    {
        $fieldName = "a";
        $config = [
            'regex'=>"/[^0-9]/is",
            "match"=>true,
        ];
        $data = [
            "a"=>"aaa",
        ];
        $regex = new \Guz\EasyValidate\Rules\Regex($fieldName, $config, $data);
        $this->assertTrue($regex->validate());
    }
    
    function testRegexNotMatch()
    {
        $fieldName = "a";
        $config = [
            'regex'=>"/[^0-9]/is"
        ];
        $data = [
            "a"=>"1111",
            "match"=>false,
        ];
        $regex = new \Guz\EasyValidate\Rules\Regex($fieldName, $config, $data);
        $this->assertTrue($regex->validate());
    }
}