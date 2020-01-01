<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 26.12.2019
 * Time: 15:14
 */

namespace Form;



class AdminLoginForm extends AbstractForm
{
    //Zweidimensionales Array, uebergibt Post-Werte an Abstract-Form.
    public function __construct()
    {

        $this->inputList =
            [
                'name'      =>[],
                'nachname'  =>[],
                'password'  =>[],

            ];

        $this->validateForm();
    }

}