<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 21.12.2019
 * Time: 14:01
 */
namespace Form;
require_once './language/lang.php';
class AbstractForm
{
    protected $inputList = [];
    protected $errorList = array();

    public function validateForm()
    {
        /*
        * Zweidimensionales Array auswerten
        * ausgehend von (Beispiel):
        * $this->inputList = ['username' =>[new NotEmptyValidator(),],'password' =>[new NotEmptyValidator(),],];
        *
        */

        foreach ($this->inputList as $inputName => $validatorList) {
            //Fehler abfangen, falls refresh und Post[input]=false

                foreach ($validatorList as $validator) {
                    //var_dump($validatorList);
                    $isvalid = true;
                    //Validator auswerten, wenn false , validieren Function gibt fehler zurueck
                    if(array_key_exists($inputName,$_POST) && $validator->validieren($_POST[$inputName]) == false) {
                        $isvalid = false;

                        /* Fehlerwert ins Fehlerarray */
                        $this->errorList[] = $validator->error($inputName);

                        // debugging:
                        //var_dump($this->errorList[] = $validator->error());

                    }
                }
            }
        }


    //Fehlerarray zurueckgeben
    public function getErrorList()
    {
       return $this->errorList;
    }

}