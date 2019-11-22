<?php
use View\Template;
class App
{
 	function __construct()
	{
    include BASEPATH."/app/includes/languageCheck.php";
	//Url verarbeiten->Inhalte einfuegen
	$url = new Router();
	//Url auf Englisch und Deutsch Abfragen und verarbeiten
	//Beispiel: Aktionen fuer /admin/add-produkt <==> /admin/produkt-hinzufuegen
	$url->checkUrl($langArray,$_SESSION['language']);
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
		if(isset($_SESSION['admin']) == "loggedIn")
		{

			return true;
		}
		else
		{

			return false;
		}
	}
}
