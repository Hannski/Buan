<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 02.01.2020
 * Time: 14:18
 */

namespace Form;
use Form\Validatoren\EmptyValidator;



class UserDataForm extends AbstractForm
{
    //Zweidimensionales Array, uebergibt Post-Werte an Abstract-Form.
    public function __construct()
    {

        $this->inputList =
            [
                'username' =>[new EmptyValidator()],

            ];

        $this->validateForm();
    }

}