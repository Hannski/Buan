<?php
class App
{
	public $langArray = array();
 	function __construct()
{
    include BASEPATH."/app/includes/languageCheck.php";
    $this->langArray = $langArray;

	//Url verarbeiten->Inhalte einfuegen
	$url = new Router();


	//Url auf Englisch und Deutsch Abfragen und verarbeiten
	//Beispiel: Aktionen fuer /admin/add-produkt <==> /admin/produkt-hinzufuegen
	// if (!isset($_SESSION['language']))
	// {
	// 	$_SESSION['language']="0";
	// }
	// else{
 //     $url->checkUrl($langArray,$_SESSION['language']);
	// }
	$url->checkUrl($this->langArray);
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
	//
	   public function renderData(string $template, array $data) {

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



	 // CAPTCHA-Funktion 
	 public function generateCaptcha() 
	 { 
	 	$md5_hash = md5(rand(0,999));
		$captcha = substr($md5_hash,15,5);

		$_SESSION['captcha']  =$captcha;

		//width,height
		$image = imagecreate(20, 5);

		//Farben

		$blau = imagecolorallocate($image,68, 101, 155);
		$rot =  imagecolorallocate($image,173, 53, 111);
		$gelb = imagecolorallocate($image,224, 177, 49);
		$lila = imagecolorallocate($image,107, 29, 186);
		$grau = imagecolorallocate($image,77, 76, 79);
		$ruby = imagecolorallocate($image,217, 144, 221);
		$white = imagecolorallocate($image,255,255,255);

		//Hintergrund
		imagefill($image,0,0,$white);
		echo $font = "/app/fonts/font24.ttf";
		//Text einfügen
			// imagettftext($image, 20, 15, 20, 40, $blau, $font, $captcha);
			// //Typ festlegen
			// header("Content-Type: image/jpeg");
			// //zu JPEG umwandeln
			// imagejpeg($image);
			// // Cache leeren
			// imagedestroy($image);
		
	 } 	
}
