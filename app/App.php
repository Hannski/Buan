<?php

use View\Template;
class App 
{
	function __construct()
	{
	require "./app/languageCheck.php";
	include "config.php";
	//header, Navigationsleiste
	require_once 'View/seitenkomponenten/header.php';
	require_once 'View/templates/home.html';
	//Url verarbeiten->Inhalte einfuegen
	$url = new Router();
		//Footer
	
	require_once 'View/seitenkomponenten/footer.php'; 
	}
	//Post Anfragen verarbeiten
	public function isPost()
	{
		if(count($_POST)>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	//Templates mit Daten rendern
	public function render($template, array $data)
	{
   
  // <!--  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css"> -->

    $view = new \View\Template($template);
    return $view->renderTemplate($data);
	}
}
