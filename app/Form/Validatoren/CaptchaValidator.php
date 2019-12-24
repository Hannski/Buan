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
        return 'notCaptcha';

    }
    public function validieren(string $value)
    {

        $access = ($_SESSION['captcha'] == $_POST['captcha']) ? true : false;
        return $access;

    }


}