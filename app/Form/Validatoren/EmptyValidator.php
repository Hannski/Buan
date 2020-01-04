<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 27.12.2019
 * Time: 12:36
 */

namespace Form\Validatoren;


class EmptyValidator
{
    public function validieren($input):bool
    {

       return !empty($input);

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
        return 'empty'.ucfirst($value);

    }
}