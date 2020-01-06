<?php


namespace Form;


use Form\Validatoren\EmptyValidator;
use Form\Validatoren\PasswordLengthValidator;
use Form\Validatoren\PasswordMatchValidator;

class PasswordMatchForm extends AbstractForm
{
    public function __construct()
    {
        $this->inputList=[
            'passwortNeu'=>[new EmptyValidator(),new PasswordMatchValidator(),new PasswordLengthValidator(),],
            'passwortMatch'=>[new EmptyValidator(),],
        ];
        $this->validateForm();
    }

}