<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 23.12.2019
 * Time: 22:20
 */

namespace Form\Validatoren;


class InputNegativeValidator
{
    public function error(string $input)
    {
        return 'tooNegative';


    }
    public function validieren($input):bool
    {
        return($input>0);


    }


}