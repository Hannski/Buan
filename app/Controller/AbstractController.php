<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 21.12.2019
 * Time: 12:56
 *
 */

declare(strict_types = 1);//typisierung strickt beibehalten.
namespace Controller;


abstract class AbstractController
{
//Template rendern:
public function render(string $template,array $data = []):string
{
    //Die Klasse Template regeöt das extrahieren der Daten aus dem array und gibt inhalte zurueck
    $view = new \View\Template($template);
    return $view->renderTemplate($data);
}

//ueberpruefen ob globales Post-array werte enthaelt.
    public function isPost($post):bool
    {

        if (count($_POST) > 0) {
            return true;
        }

        return false;
    }
}