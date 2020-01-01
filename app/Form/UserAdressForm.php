<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 30.12.2019
 * Time: 13:39
 */

namespace Form;


class UserAdressForm extends AbstractForm
{
    //Zweidimensionales Array, uebergibt Post-Werte an Abstract-Form.
    public function __construct()
    {

        $this->inputList =
            [
                'strasse' =>[],
                'nummer' =>[],
                'ort'  =>[],
                'plz'  =>[],
                'land'  =>[],

            ];

        $this->validateForm();
    }
}