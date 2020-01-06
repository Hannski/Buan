<?php

/* In dieser Datei werden Url-Parameter geprüft und entsprechend verarbeitet. */
use Controller\DefaultController;
/*DEBUGGING*/
//echo $_SESSION['admin'];
//echo $_SESSION['adminId'];
//echo $_SESSION['super'];
class Router
{

    public function __construct()
    {
        include BASEPATH . "/app/includes/languageCheck.php";
    }

//Url Verarbeiten, Funktion gibt true oder false zurueck-> :void
    public function resolveUrl(): void
    {
        //Ist die Url nicht gesetzt-> index.php, dann default controller mit default action
        if (!array_key_exists('url', $_GET)) {
            (new DefaultController())->defaultAction();
            return;
        }

        //Url Interpretieren. 1.->Controller ,Trennzeichen "-",2.->Action im Controller
        $url = $_GET['url'];
        $url = str_replace('/', '', $url);


        $urlChunks = explode('-', $url);
        //ist an stelle 1 ueberhaupt etwas?
        if(count($urlChunks)!=2)
        {
            echo  Controller\AbstractController::render('seitenkomponenten/header');
            echo  Controller\AbstractController::render('seitenkomponenten/nav');
            echo Controller\AbstractController::render('pages/alerts/404');
            return;
        }
        //nach welchem Controller wird gesucht?
        list($controllerName,$actionName)=$urlChunks;

        //Controllerklasse laden aus Namespace: Controller/$varCtrl;
        $controllerClass = sprintf('Controller\\%sCtrl', ucfirst($controllerName));

        //Fehler abfangen:
        if (class_exists($controllerClass)) {
            //Klasse instanzieren
            $controller = new $controllerClass();

            //nach welcher Methode innerhlab der Controllerklasse wird gesucht?
            $methodName = sprintf('%sAction', $actionName);
            //Fehler abfangen: gibt es die Methode in der Controllerklasse?, wenn ja: aufrufen
            if (method_exists($controller, $methodName)) {
                $controller->$methodName();

            } else {
                //Problem: Kontroller gefunden, Methode nicht.
                echo Controller\AbstractController::render('seitenkomponenten/header');
                echo  Controller\AbstractController::render('seitenkomponenten/nav');
                echo Controller\AbstractController::render('pages/alerts/404');

            }
        } else {
          echo  Controller\AbstractController::render('seitenkomponenten/header');
          echo  Controller\AbstractController::render('seitenkomponenten/nav');
          echo Controller\AbstractController::render('pages/alerts/404');


        }


    }
}


?>