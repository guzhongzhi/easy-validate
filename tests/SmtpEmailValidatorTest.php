<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/23
 * Time: 1:15
 */

namespace Guz\EasyValidate\Tests;


use Guz\EasyValidate\Rules\SmtpEmailValidator;

require_once 'vendor/autoload.php';
class SmtpEmailValidatorTest extends \PHPUnit_Framework_TestCase
{
    
    
    function testEmail()
    {
        $config = [
        
        ];
        $data = [
            "email"=>"guzhongzhi@qq.com"
        ];
        $validator = new SmtpEmailValidator("email",$config,$data);
        $this->assertTrue($validator->validate());
    }
}