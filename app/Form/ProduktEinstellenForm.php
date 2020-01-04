<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 03.01.2020
 * Time: 17:21
 */

namespace Form;
use Form\Validatoren\EmptyValidator;
use Form\Validatoren\InputNegativeValidator;



class ProduktEinstellenForm extends AbstractForm
{
//Zweidimensionales Array, uebergibt Post-Werte an Abstract-Form.
    public function __construct()
    {
        // Fehlerausgabe wenn: Felder nichtausgefuellt, Passwoerter nicht uebereinstimmen.
        $this->inputList =
            [
                'pd_name'   =>[
                    new EmptyValidator(),],
                'pe_name'=>[new EmptyValidator(),],
                'pd_beschreibung'=>[new EmptyValidator(),],
                'pe_beschreibung'=>[new EmptyValidator(),],
                'p_preis'=>[new EmptyValidator(),
                    new InputNegativeValidator('p_preis')],
                'menge'=>[new EmptyValidator(), new InputNegativeValidator('menge'),],

            ];

        $this->validateForm();
    }

}