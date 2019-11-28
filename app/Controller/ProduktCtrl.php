<?php
namespace Controller;
use \Model\Resource\ProduktMdl ;
use App;
class ProduktCtrl
{
	public $errorArray = array();

	public function addProduct()
	{
	    $name_de = $_POST['pd_name'];
	    $name_en = $_POST['pe_name'];
	    $beschreibung_de = $_POST['pd_beschreibung'];
	    $beschreibung_en = $_POST['pe_beschreibung'];
	    $preis = $_POST['p_preis'];
	    $dateiname = $_FILES['dateiname']['name'];
	    $dateityp = $_FILES['dateiname']['type'];
	    // fhler abfangen : var_dump($_FILES) ;
	    if ($this->checkForm ($name_de,$name_en,$beschreibung_de,$beschreibung_en,$preis,$dateityp) &&empty($this->errorArray))
	    {
	    //Zuweisung werte
		$produkt = App::getModel('ProduktMdl');
		$produkt->setNameDe($name_de);
		$produkt->setNameEn($name_en);
		$produkt->setBeschreibungDe($beschreibung_de);
		$produkt->setBeschreibungEn($beschreibung_en);
		$produkt->setPreis($preis);
		$produkt->setDateiname($dateiname);
		//In Datenbank schreiben
		$resource = App::getResourceModel('ProduktMdl');
		$resource->insertProdukt($produkt); 
		
	    }
	    else
	    {
	    	$this->showErrors();
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

    public function checkForm($pd_name,$pe_name,$pd_beschreibung,$pe_beschreibung,$p_preis,$dateityp)
    {
    if(empty($_POST['pd_name']) || empty($_POST['pe_name']))
	{
	$this->errorArray[] = "emptyPname";
	return $this->errorArray;
	}
	elseif(empty($pd_beschreibung))
	{
		$this->errorArray[]= "emptyDes";
		return $this->errorArray;
	}
	elseif ($p_preis<=0)
	{
		$this->errorArray[]= "preiszuklein";
		return $this->errorArray;
	}
	elseif($_FILES['dateiname']['type'] !== "image/jpg")
	{
		$this->errorArray[] = "Dateityp";
		return $this->errorArray;
	}
	if(!empty($this->errorArray))
   {
    return $this->errorArray;
   }
   else
   {
   	return true;
   }


  }	

    public function showErrors()
   {
   	 foreach ($this->errorArray as $value)
    {
    //Fehler ausgeben
    include BASEPATH.'/app/includes/languageCheck.php';
    echo $langArray[$opt][$value];
    }
  }

    

 
}
	