<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/23
 * Time: 1:15
 */

namespace Guz\EasyValidate\Tests;


use Guz\EasyValidate\Rules\Email;
use Guz\EasyValidate\Rules\SmtpEmailValidator;
use Guz\EasyValidate\Validate;

class EmailValidatorTest extends Tester
{
    
    function testSmtpEmailValidator()
    {
        $config = [
            "email"=>[
                "rules"=>[
                    [
                        "rule"=>SmtpEmailValidator::CODE
                    ]
                ]
            ]
        ];
        $data = [
            "email"=>"guzhongzhi@qq.com"
        ];
        $validator = new Validate();
        $this->assertFalse($validator->validate($data,$config));
    }
    
    function testEmail()
    {
        $config = [
            "email"=>[
                "rules"=>[
                    [
                        "rule"=>Email::CODE,
                    ]
                ]
            ]
        ];
        $data = [
            "email"=>"guzhongzhi@qq.com"
        ];
        $validator = new Validate();
        $this->assertTrue($validator->validate($data,$config));
    }
}