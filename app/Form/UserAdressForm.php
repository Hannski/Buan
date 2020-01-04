<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 30.12.2019
 * Time: 13:39
 */

namespace Form;


use Form\Validatoren\EmptyValidator;

class UserAdressForm extends AbstractForm
{
    //Zweidimensionales Array, uebergibt Post-Werte an Abstract-Form.
    public function __construct()
    {

        $this->inputList =[

                'vorname'=>[new EmptyValidator(),],
                'nachname'=>[new EmptyValidator(),],
                'strasse' =>[new EmptyValidator(),],
                'nummer' =>[new EmptyValidator(),],
                'ort'  =>[new EmptyValidator(),],
                'plz'  =>[new EmptyValidator(),],
                'land'  =>[new EmptyValidator(),],

            ];

        $this->validateForm();
    }
}