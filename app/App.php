<?php
use View\Template;
class App
{
 	function __construct()
	{	
	//Url verarbeiten->Inhalte einfuegen
	$url = new Router();
	$url->checkUrl();
	}
	//Templates mit Daten rendern
	// siehe /View/Template
	public function render($template, array $data)
	{
	include BASEPATH."/app/includes/languageCheck.php";
	$langArray = $langArray;
    $view = new \View\Template($template);
    return $view->renderTemplate($data, $langArray);
	}
	//Sessions verwalten:

	public function adminSess()
	{
		if(isset($_SESSION['admin']) =="loggedIn")
		{

			return true;
		}
		else
		{

			return false;
		}
	}
}
