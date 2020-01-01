<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 27.12.2019
 * Time: 12:56
 */

namespace Form\Validatoren;


class AdminCredentialValidator
{
    public $value;
    public function __construct($value)
    {
        $this->value = $value;
    }

    public function validieren():bool
    {
        $passwordLength = strlen($_POST[$this->value]);
        if ($passwordLength < 3 || $passwordLength > 20)
        {
            echo $passwordLength;
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
        return $this->value.'Length';

    }


}