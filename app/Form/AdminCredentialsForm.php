<?php


namespace Form;


use Form\Validatoren\EmptyValidator;

class AdminCredentialsForm extends AbstractForm
{
    public function __construct()
    {
        $this->inputList=[
            'vorname'=>[new EmptyValidator(),],
            'nachname' => [new EmptyValidator(),],
            ];
        $this->validateForm();
    }
}