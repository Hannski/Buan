<?php
namespace Controller;
use \Model\Resource\ProduktMdl ;
use App;
class ProduktCtrl
{
	public $errorArray = array();


	//Alle produkte 
	public function showProducts()
	{
		// resource model instanzieren
        /** @var \Model\Resource\Bild $model */
        $model = App::getResourceModel('ProduktMdl');

        // bilder abrufen
        $produkteArray = $model->getAllProducts();

        // bilder darstellen / template
        return App::renderData('home', array('produkteArray' => $produkteArray));
	}



	public function addProduct()
	{
	    $name_de = $_POST['pd_name'];
	    $name_en = $_POST['pe_name'];
	    $beschreibung_de = $_POST['pd_beschreibung'];
	    $beschreibung_en = $_POST['pe_beschreibung'];
	    $preis = $_POST['p_preis'];
	    $dateiname = $_FILES['dateiname']['name'];
	    $dateityp = $_FILES['dateiname']['type'];
	    $menge = $_POST['Menge'];
	    // fhler abfangen : var_dump($_FILES) ;
	    if ($this->checkForm ($name_de,$name_en,$beschreibung_de,$beschreibung_en,$preis,$dateityp,$menge) && empty($_SESSION['errors']))
	    {
	    //Zuweisung werte
		$produkt = App::getModel('ProduktMdl');
		$produkt->setNameDe($name_de);
		$produkt->setNameEn($name_en);
		$produkt->setBeschreibungDe($beschreibung_de);
		$produkt->setBeschreibungEn($beschreibung_en);
		$produkt->setPreis($preis);
		$produkt->setDateiname($dateiname);
		$produkt->setMenge($menge);
		//In Datenbank schreiben
		$resource = App::getResourceModel('ProduktMdl');
		$resource->insertProdukt($produkt); 
		
	    }
	    else
	    {
	    	 var_dump($_SESSION['errors']);
	    }
	   
    }
    public function addFile()
    {
    	//Datei in den Ordner /Assets verschieben
   		$uploads_dir = BASEPATH.'/Assets/';
   		$uploadfile = $uploads_dir . basename($_FILES['dateiname']['name']);
   		//Fehlerhilfe
    	//var_dump($_FILES);
    	// echo is_uploaded_file($_FILES['dateiname']['tmp_name']);
        $tmp_name = $_FILES["dateiname"]["tmp_name"];
        $name = basename($_FILES["dateiname"]["name"]);
        move_uploaded_file($tmp_name,$uploadfile);
    }

    //TODO:: FEHLER ABFANGEN!!!
    public function checkForm($pd_name,$pe_name,$pd_beschreibung,$pe_beschreibung,$p_preis,$dateityp)
    {
    	
    $fehler = $_SESSION['errors']; 
 	
    if(empty($pd_name || $pe_name || $pd_beschreibung || $p_preis))
	{ 
	   $fehler[] = "emptyPname";
	   $fehler[] = "emptyDes";
	   $fehler[] = "emptyFields";
	}
	elseif ($p_preis<=0)
	{
		$fehler[] = "preiszuklein";		
	}
	elseif( $dateityp !== "image/jpeg")
	{
		$fehler[] = "dateityp";
		// echo $dateityp;
	}
	else
		{

			if(!empty($fehler)){return $fehler;}
			else
				{return true;}
		}

	
	}

    

 
}
	