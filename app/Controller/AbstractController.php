<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 21.12.2019
 * Time: 12:56
 *
 */

declare(strict_types=1);//typisierung strickt beibehalten.
namespace Controller;


abstract class AbstractController
{
    //Template rendern:
    public function render(string $template, array $data = [], array $data2 = []): string
    {
        //Die Klasse Template regeöt das extrahieren der Daten aus dem array und gibt inhalte zurueck
        $view = new \View\Template($template);
        return $view->renderTemplate($data, $data2);
    }


    //Fehler rendern wenn Fehler in einem FehlerArray vorhanden
    public function renderErrors($errorArray)
    {
        if (empty($errorArray)) {
            return false;
        } else {
            echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
        }
    }

    //ueberpruefen ob globales Post-array werte enthaelt.
    public function isPost($post): bool
    {

        if (isset($_POST[$post])) {
            return true;
        }

        return false;
    }

    //welche Navigation wird angezeigt??
    public function getNav()
    {
        //html-header ausgeben
        echo $this->render("seitenkomponenten/header");
        //Superadmin eingeloggt??->superadmin Navbar
        if ($this->isSuperAdmin()) {
            echo $this->render("pages/user/UserNav");
        } //regulaerer Admin eingeloggt?-> admin-navbar
        elseif ($this->isAdmin()) {
            echo $this->render("pages/user/UserNav");

        } elseif ($this->isUser()) {
            echo $this->render("pages/user/UserNav");
        } //kein admin eingeloggt, besucher haben hier nichts zu suchen->go home
        else {
            echo $this->render("pages/user/UserNav");
        }
    }


    /*handelt es sich bei dem eingeloggten Admin um den Super Admin? */
    public function isSuperAdmin(): bool
    {
        return array_key_exists('super', $_SESSION) && $_SESSION['super'] == "loggedIn";

    }

    /*Ist der Admin eingeloggt? */
    //Sessions verwalten:
    public function isAdmin()
    {
        return array_key_exists('admin', $_SESSION) && $_SESSION['admin'] == "loggedIn";
    }

    public function isUser()
    {
        return array_key_exists('user', $_SESSION) && $_SESSION['user'] == "loggedIn";
    }
}