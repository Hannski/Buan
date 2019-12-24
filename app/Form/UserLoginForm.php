<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 21.12.2019
 * Time: 14:08
 */

namespace Form;
use Form\Validatoren\CaptchaValidator;

class UserLoginForm extends AbstractForm
{
    //Zweidimensionales Array, uebergibt Post-Werte an Abstract-Form.
    public function __construct()
    {

        $this->inputList =
        [
            'username' =>[],
            'password' =>[],
            'captcha'  =>[new CaptchaValidator(),],
        ];

    $this->validateForm();
    }

}