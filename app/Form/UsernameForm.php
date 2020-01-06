<?php


namespace Form;


use Form\Validatoren\EmptyValidator;

class UsernameForm extends AbstractForm
{
    public function __construct()
    {
        $this->inputList = ['username' => [new EmptyValidator(),],];
        $this->validateForm();
    }
}