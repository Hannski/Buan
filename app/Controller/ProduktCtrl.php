<?php
namespace Controller;
use \Model\Resource\ProduktMdl ;
use App;
class ProduktCtrl
{

	//abrufen: Alle produkte die in Bestand sind und nicht gesperrt
	public function showProducts()
	{
		// resource model instanzieren
       
        $model = App::getResourceModel('ProduktMdl');

        // Produkte abrufen
        $produkteArray = $model->getAllProducts();

        // Produkte-array fuer Anzeige in Array bereitstellen
        return array('produkteArray'=> $produkteArray);
	}


	//abrufen:Alle alle produkte, egal ob auf Lager oder Gesperrt
	public function showAdminProducts()
	{
		// resource model instanzieren
      
        $model = App::getResourceModel('ProduktMdl');

        // Produkte abrufen
        $produkteArray = $model->getAllAdminProducts();

        // Produkte darstellen / template
        return array('produkteArray'=> $produkteArray);
	}
   
   //Abrufen: Produkt mit einer bestimmten id abrufen
    public function showProductById($id)
    {
    	// resource model instanzieren
        $model = App::getResourceModel('ProduktMdl');

        // bilder abrufen
        $produkteArray = $model-> getProduktById($id);

        // bilder darstellen / template
        return array('produkteArray'=> $produkteArray);

    }

    //schreiben:: produkt in die Datenbank schreiben
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
    //schreiben:Datei in den Ordner: Projektordner/Assets kopieren 
    public function addFile()
    {
    	//Datei in den Ordner /Assets verschieben
   		$uploads_dir = BASEPATH.'/Assets/';
   		$uploadfile = $uploads_dir . basename($_FILES['dateiname']['name']);
   		//Debugging:
    	//var_dump($_FILES);
    	// echo is_uploaded_file($_FILES['dateiname']['tmp_name']);
        $tmp_name = $_FILES["dateiname"]["tmp_name"];
        $name = basename($_FILES["dateiname"]["name"]);
        move_uploaded_file($tmp_name,$uploadfile);
    }
    //Bearbeiten: 
    public function updateProduct()
    {
    	/* der Einfachheithalber wird an dieser Stelle nicht mit gettern und settern gearbeitet, sondern Werte direkt an das resource-model uebermittelt*/
    	//Wert des Formular-Buttons Beispiel: "Dateiname" 
    	$edit = $_POST['aendern'];
    	//Produkt-Id
    	$id = $_POST ['id'];
    	$resource = App::getResourceModel('ProduktMdl');
    	//Name-Deutsch aendern
    	if ($edit=="name_de")
    	{$value=$_POST['name_de'];}
    	elseif ($edit=="name_en")
		{ $value = $_POST['name_en'];}
		elseif($edit=="beschreibung_de"){$value = $_POST['desc_de'];}
		elseif($edit=="beschreibung_en"){$value = $_POST['desc_en'];}
		elseif($edit=="preis"){$value= $_POST['preis'];}
		elseif($edit=="bestand"){$value= $_POST['bestand'];}
		elseif($edit=="dateiname"){$value= $_POST['dateiname'];}
		elseif($edit == "gesperrt"){$value= $_POST['gesperrt'];}
		$resource->UpdateProdukt($id,$edit,$value);
    }
 	// bearbeiten: Bilddatei in unterordner ggf. ersetzen : "Projektordner/Assets/"
 	public function updateFile()
 	{
 		if (isset($_POST['datei']))
 		{
 			//Deteinamen in Datenbank Aendern:
 			$id = $_POST ['id'];
    		$resource = App::getResourceModel('ProduktMdl');
    		$edit= "dateiname";
    		$value = $_FILES['dateiname']['name'];
    		$resource->UpdateProdukt($id,$edit,$value);
    		//debuging:: echo $_POST['dateiAlt'];
    		//alte Datei in Assetordner loeschen, wenn vorhanden: 
    		if(file_exists(BASEPATH."/Assets/".$_POST['dateiAlt']))
    		{
    		//@: Fehler unterdruecken falls beispielsweise "aktualisieren" mehrmals akiviert wird.
    		$file_to_delete = $_POST['dateiAlt'];
			 @unlink(BASEPATH."/Assets/".$file_to_delete);
    		}else{
    		
    		}
   			
    		//Datei in Assetordner kopieren:
    		self::addFile();
 
    		
 		}
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
	