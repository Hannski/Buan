<?php
/*
 * Datei zum rendern von Templates und uebergeben von Daten an das Template*/
namespace Controller;

use View\Template;

class Base
{
public function render($template, array $data)
{
   ?>
   <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
   <?
    $view = new \View\Template($template);
    return $view->renderTemplate($data);

}

}