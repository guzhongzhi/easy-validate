<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/23
 * Time: 0:00
 */

namespace Guz\EasyValidate\Rules;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

/**
 * [
 *   validation=>MultipleValidationWithAnd([])
 *   validation=>RFCValidation
 * ]
 * Class Email
 *
 * @package Guz\EasyValidate\Rules
 */
class Email extends Rule
{
    const CODE = "email";
    
    protected function _validate()
    {
        $value = $this->getValue();
        $rule = isset($this->config["validation"]) ? $this->config["validation"] :new RFCValidation();
        $validator = new EmailValidator();
        if(!$validator->isValid($value, $rule)) {
            $this->errors[] = $this->generateError();
        }
    }
}
