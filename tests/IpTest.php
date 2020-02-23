<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/23
 * Time: 16:48
 */

namespace Guz\EasyValidate\Tests;


use Guz\EasyValidate\Rules\Ip;
use Guz\EasyValidate\Validate;

class IpTest extends Tester
{
    
    public function testIp() {
        $ips = [
            "331.2.6.96"=> false,
            "1.1.1.1" => true,
            "0.0.0.0" => true,
            "2.5.7.1" => true,
            "11"=>false,
        ];
        $data = [];
        $rules = [
            "ip"=>[
                "rules"=>[
                    [
                        "rule"=>Ip::CODE
                    ]
                ]
            ]
        ];
        $validator = new Validate();
        echo PHP_EOL;
        foreach($ips as $ip=>$result) {
            $data["ip"] = $ip;
            $v = $validator->validate($data,$rules);
            echo $ip . " " . ($v ? "TRUE" :"FALSE"),PHP_EOL;
            if($result) {
                $this->assertTrue($v);
            } else {
                $this->assertFalse($v);
            }
            
        }
        
    }
}