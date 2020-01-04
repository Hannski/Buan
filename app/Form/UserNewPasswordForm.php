<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 02.01.2020
 * Time: 14:18
 */

namespace Form;
use Form\Validatoren\EmptyValidator;
use Form\Validatoren\passwordLengthValidator;
use Form\Validatoren\passwordMatchValidator;


class UserNewPasswordForm extends AbstractForm
{
    //Zweidimensionales Array, uebergibt Post-Werte an Abstract-Form.

    public function __construct()
    {
        //Fehler abfangen: passwoerter stimmen nicht ueberein
        // passwort hat nicht die richtige laenge
        $this->inputList =
            [
                'passwortNeu' =>[new EmptyValidator(),new passwordLengthValidator('passwortNeu','passwortMatch'),
                                  new PasswordMatchValidator(),
                                 ],
                'passwortMatch' =>[new EmptyValidator()],
                'passwortAlt'  =>[new EmptyValidator()],
            ];

        $this->validateForm();
    }

}