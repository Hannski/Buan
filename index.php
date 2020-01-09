<?php
/*
 *Willkommen in der Indexdatei. Hier wird das Programm gestartet.
 * Bevor das Projekt laufen kann, definieren Sie bitte die Variable 'WEB_ROOT'
 * mit dem entsprechneden Pfad in Ihrem Server Rootdirectory
 * */
class Start
{
	function __construct()
	{  //Session starten
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }

		//Basis defienieren
		define ("BASEPATH",dirname(__FILE__));
		define("BASE", __DIR__);

		//webroot: muss angepasst werden.
		define ('WEB_ROOT', 'http://localhost:8080/Buan/');
		//define ('WEB_ROOT', 'Path-to-projekt/Buan/');

		//Klassen automatisch laden:
	    spl_autoload_register(function($class)
	    {
			$newName = str_replace('\\', '/', $class);

			/*Dateipfad*/
			$path = "app/$newName.php";

			/*Fehler abfangen, Datei einbinden*/
			if (!class_exists($class))
			{
			if (file_exists($path))
				{
					require $path;
				}
			}
		});
        // neuen Router.
        $router = new Router();
        //Url interpretieren
        $router->resolveUrl();

	}


}
//Progammstart
$hi = new Start();









