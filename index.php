<?php

class Start
{
	function __construct()
	{
		//Session starten
		session_start();

		//Klassen laden
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

		//start

		$app = new App();	
	}

}
//Progammstart
$hi = new Start();



		

	



