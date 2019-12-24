<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 23.12.2019
 * Time: 20:37
 * Dokument bezieht sich auf das Template: UserRegistration.php
 */

namespace Form;
use Form\Validatoren\NotEmptyValidator;
use Form\Validatoren\PasswordMatchValidator;

class UserRegisterForm extends AbstractForm
{
    public function __construct()
    {
        $this->inputList =
            [
                'username'  =>[],
                'password1' =>[new PasswordMatchValidator()],
                'password2' =>[],
                'msg'       =>[],
            ];

        $this->validateForm();

    }


}