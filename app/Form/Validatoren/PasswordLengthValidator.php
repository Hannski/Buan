<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 27.12.2019
 * Time: 12:36
 */

namespace Form\Validatoren;


class PasswordLengthValidator
{
    public function validieren():bool
    {

        $passwordLength = strlen($_POST['password1']);
        if ($passwordLength < 5 OR $passwordLength > 10)
        {
           return false;
        }else
            {
                return true;
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
        return 'pwTooLong';

    }
}