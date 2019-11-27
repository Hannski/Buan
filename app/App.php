<?php
class App
{
 	function __construct()
	{
	//Url verarbeiten->Inhalte einfuegen
	$url = new Router();
	include BASEPATH."/app/includes/languageCheck.php";

	//Url auf Englisch und Deutsch Abfragen und verarbeiten
	//Beispiel: Aktionen fuer /admin/add-produkt <==> /admin/produkt-hinzufuegen
	$url->checkUrl($langArray,$_SESSION['language']);
	}
	//Templates mit Daten rendern
	// siehe /View/Template
	public function render($template, array $data)
	{	
		include BASEPATH."/app/includes/languageCheck.php";
		include BASEPATH.'/templates/'.$template.'.php';
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
