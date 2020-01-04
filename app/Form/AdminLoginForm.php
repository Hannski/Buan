<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 26.12.2019
 * Time: 15:14
 */

namespace Form;



use Form\Validatoren\EmptyValidator;

class AdminLoginForm extends AbstractForm
{
    //Zweidimensionales Array, uebergibt Post-Werte an Abstract-Form.
    public function __construct()
    {

        $this->inputList =
            [
                'vorname'    =>[new EmptyValidator(),],
                'nachname'  =>[new EmptyValidator(),],
                'password'  =>[new EmptyValidator(),],
            ];

        $this->validateForm();
    }

}