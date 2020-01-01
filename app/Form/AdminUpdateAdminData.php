<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 28.12.2019
 * Time: 14:02
 */

namespace Form;


class AdminUpdateAdminData extends AbstractForm
{
    //Zweidimensionales Array, uebergibt Post-Werte an Abstract-Form.
    public function __construct()
    {

        $this->inputList =
            [
                'vorname' =>[],
                'nachname' =>[],
            ];

        $this->validateForm();
    }

}