<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 23.12.2019
 * Time: 20:35
 */

namespace Form\Validatoren;


class PasswordMatchValidator
{
    public function validieren():bool
    {
            if ($_POST['password1'] == $_POST['password2'])
            {
                return true;
            }else{
                return false;
            }
    }

    /*
    * Fehlerausgabe
    *
    */
    public function error($value):string
    {
        /*
         * Fehler Feldspezifisch ausgeben, Beispiel: >>Passwort<< darf nicht leer sein. Dazu:
         * Korrespondierenden arraykey in /language/lang.php "langArray" zurueckgeben:
        */
        return 'noMatch';

    }
}