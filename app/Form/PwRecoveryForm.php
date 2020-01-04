<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 04.01.2020
 * Time: 16:14
 */

namespace Form;


use Form\Validatoren\EmptyValidator;

class PwRecoveryForm extends AbstractForm
{
    public function __construct()
    {
        $this->inputList=
            [
              'username' =>[new EmptyValidator(),],
            ];
    $this->validateForm();
    }


}