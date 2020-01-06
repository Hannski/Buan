<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 26.12.2019
 * Time: 22:51
 */

namespace Form;


use Form\Validatoren\AdminCredentialValidator;
use Form\Validatoren\EmptyValidator;
use Form\Validatoren\PasswordMatchValidator;
use Form\Validatoren\PasswordLengthValidator;

class AddAdminForm extends AbstractForm
{
    //Zweidimensionales Array, uebergibt Post-Werte an Abstract-Form.
    public function __construct()
    {
        // Fehlerausgabe wenn: Felder nichtausgefuellt, Passwoerter nicht uebereinstimmen.
        $this->inputList =
            [
                'vorname'   =>[
                    new EmptyValidator(),
                ],
                'nachname'  =>[
                    new EmptyValidator()
                ],
                'password1' =>[
                    new PasswordMatchValidator(),
                    new PasswordLengthValidator(),
                    ],
                'passwortMatch' =>[],

            ];

        $this->validateForm();
    }

}