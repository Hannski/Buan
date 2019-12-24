<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 21.12.2019
 * Time: 14:02
 */

namespace Form\Validatoren;


abstract class AbstractValidator
{
    abstract public function validieren(string $value):bool;
}