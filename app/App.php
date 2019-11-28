<?php
class App
{
 	function __construct()
{
    include BASEPATH."/app/includes/languageCheck.php";
    $langArray = $langArray;

	//Url verarbeiten->Inhalte einfuegen
	$url = new Router();
	include BASEPATH."/app/includes/languageCheck.php";

	//Url auf Englisch und Deutsch Abfragen und verarbeiten
	//Beispiel: Aktionen fuer /admin/add-produkt <==> /admin/produkt-hinzufuegen
	if (!isset($_SESSION['language']))
	{
		$_SESSION['language']= "0";
	}
	else{
     $url->checkUrl($langArray,$_SESSION['language']);
	}
	
	}

	 public static function getModel(string $model) {
        $class = "\\Model\\$model";
        return new $class();
    }

    public static function getResourceModel(string $model) {
        $class = "\\Model\\Resource\\$model";
        return new $class();
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
