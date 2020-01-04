<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 23.12.2019
 * Time: 22:20
 */

namespace Form\Validatoren;


class CaptchaValidator
{
    public function error()
    {
        //language option und Spracharray
        include './language/lang.php';
        include './app/includes/languageCheck.php';
        //Fehler zurueckgeben -> schluessel fuer LanguageArray ins Fehlerarray


        return 'captchaNope';

    }
    public function validieren(string $value)
    {

        $access = ($_SESSION['captcha'] == $_POST['captcha']) ? true : false;
        return $access;

    }


}