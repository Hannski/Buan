<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 28.12.2019
 * Time: 14:11
 */

namespace Form;


class AdminUpdatePassword extends AbstractForm
{

    //Zweidimensionales Array, uebergibt Post-Werte an Abstract-Form.
    public function __construct()
    {

        $this->inputList =
            [
                'password' =>[],
                'password2' =>[],
            ];

        $this->validateForm();
    }


}