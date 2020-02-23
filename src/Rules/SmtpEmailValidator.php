<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/23
 * Time: 1:13
 */

namespace Guz\EasyValidate\Rules;

use SMTPValidateEmail\Validator as EmailValidator;

class SmtpEmailValidator extends Rule
{
    const CODE = "smtpEmailValidator";
    
    protected function _validate()
    {
        $email = isset($this->data[$this->fieldName]) ? $this->data[$this->fieldName] : "";
        $sender    = $email;
        $validator = new EmailValidator($email, $sender);

        $results   = $validator->validate();
    
        if(isset($results[$email]) && $results[$email]) {
            return true;
        }
        $this->errors[] = $this->getErrorMessage();
    }
}
