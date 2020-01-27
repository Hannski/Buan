<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 21.12.2019
 * Time: 12:56
 *
 */
declare(strict_types=1);

namespace Controller;


abstract class AbstractCtrl
{
    //Template rendern:
    public function render(string $template, array $data = [], array $data2 = []): string
    {
        //Die Klasse Template regelt das extrahieren der Daten aus dem array
        $view = new \View\Template($template);
        //2 arrays koenne uebergeben und extrahiert werden
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
        return (isset($_POST[$post]));
    }

    //header und Navigation ??
    public function getNav()
    {
        //html-header ausgeben
        echo $this->render("seitenkomponenten/header");
        echo $this->render("seitenkomponenten/navigation");
    }

    //footer ausgeben
    public function getFooter()
    {
        echo $this->render("seitenkomponenten/footer");
    }


    public function allAdminsOnly()
    {
        if(($this->isAdmin() == false && $this->isSuperAdmin() == false))
        {
            header("Location:".WEB_ROOT."access-denied");
        }
    }

    public function superOnly()
    {
        if(!$this->isSuperAdmin() == true )
        {
            header("Location:".WEB_ROOT."access-denied");
        }
    }
    public function userOnly()
    {
        if(!$this->isUser() == true)
        {
            header("Location:".WEB_ROOT."access-denied");
        }
    }


    public function guestOnly()
    {
        if ($this->isUser()){
            header("Location:".WEB_ROOT."access-denied");
        }
     elseif ($this->isSuperAdmin())
     {
         header("Location:".WEB_ROOT."access-denied");
     }
        elseif($this->isAdmin())
        {
            header("Location:".WEB_ROOT."access-denied");
        }
        else{}

    }



    /* admin und admin eingeloggt? */
    public function isSuperAdmin(): bool
    {
        return array_key_exists('super', $_SESSION) && $_SESSION['super'] == "loggedIn";
    }

    /*admin und admin eingeloggt?*/
    public function isAdmin()
    {
        return array_key_exists('admin', $_SESSION) && $_SESSION['admin'] == "loggedIn";
    }

    /*User und User eingeloggt?*/
    public function isUser()
    {
        return array_key_exists('user', $_SESSION) && $_SESSION['user'] == "loggedIn";
    }
}