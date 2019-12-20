<?php
class App
{
	public $langArray = array();
 	function __construct()
{
  


	//Url verarbeiten->Inhalte einfuegen
	$url = new Router();
	$url->checkUrl();
	}
	//Namespace Model-Pfad
	 public static function getModel(string $model) {
        $class = "\\Model\\$model";
        return new $class();
    }
    //Namespace Resource-Model-Pfad
    public static function getResourceModel(string $model) {
        $class = "\\Model\\Resource\\$model";
        return new $class();
    }
	//Templates mit Daten rendern
	// siehe: /View/Template
	public function render($template)
	{	
		include BASEPATH."/app/includes/languageCheck.php";
		include BASEPATH.'/templates/'.$template.'.php';
	}
	//Array daten Rendern
	   public function renderData(string $template, array $data)
	{
        $view = new \View\Template($template);
        return $view->renderTemplate($data);
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
