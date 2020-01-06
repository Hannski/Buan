<?php
namespace Controller;
use \Model\Resource\ProduktMdl ;
use Form\ProduktEinstellenForm;

class ProduktCtrl extends AbstractController
{

    //Produkte verwalten
    public function verwaltenAction()
    {
        $this->getNav();
        $resource = new ProduktMdl();
        $produkteArray = $resource->getAllProducts();
        echo $this->render('pages/products/editp',array('produkteArray'=>$produkteArray));
    }

	//abrufen: Alle produkte die in Bestand sind und nicht gesperrt
	public function showProducts()
	{
		// resource model instanzieren
       
        $model = new ProduktMdl();

        // Produkte abrufen
        $produkteArray = $model->getAllProducts();

        // Produkte-array fuer Anzeige in Array bereitstellen
        return (array('produkteArray'=> $produkteArray));
	}


	//abrufen:Alle alle produkte, egal ob auf Lager oder Gesperrt
	public function showAdminProducts()
	{
		// resource model instanzieren
      
        $model = new ProduktMdl();

        // Produkte abrufen
        $produkteArray = $model->getAllAdminProducts();

        // Produkte darstellen / template
        return array('produkteArray'=> $produkteArray);
	}
   
   //Abrufen: Produkt mit einer bestimmten id abrufen
    public function showProductById($id)
    {
    	// resource model instanzieren
        $model = new ProduktMdl();

        // bilder abrufen
        $produkteArray = $model-> getProduktById($id);

        // bilder darstellen / template
        return array('produkteArray'=> $produkteArray);

    }


    //Produkt-erstellen Action
    public function erstellenAction()
    {
        //Fehler abfangen
        if($this->isPost('add_p'))
        {
            //Fehler abfangen:
            $form= new ProduktEinstellenForm();
            $errorArray = $form->getErrorList();
            if(!empty($errorArray))
            {
                $this->getNav();
                echo $this->render('seitenkomponenten/errors',array('errorArray'=>$errorArray));
                echo $this->render('pages/products/add_p');
            }
            else
            {
                //ProduktResourceModel
                $produkt=new ProduktMdl();
                //Model
                $p_info = new \Model\ProduktMdl();
                $p_info->setNameDe($_POST['pd_name']);
                $p_info->setNameEn($_POST['pe_name']);
                $p_info->setBeschreibungDe($_POST['pd_beschreibung']);
                $p_info->setBeschreibungEn($_POST['pe_beschreibung']);
                $p_info->setPreis($_POST['p_preis']);
                $p_info->setMenge($_POST['menge']);
                $this->addFile();
                //hat  alles geklapp?
                if($this->addProduct())
                {
                    $this->getNav();
                    //gute nachrichten
                    $errorArray [] = 'productYes';
                    echo $this->render('seitenkomponenten/errors',array('errorArray'=>$errorArray));
                    echo $this->render('pages/products/add_p');
                }else
                {
                    $this->getNav();
                    //schlechte nachrichten
                    $errorArray [] = 'dbProblem';
                    echo $this->render('seitenkomponenten/errors',array('errorArray'=>$errorArray));
                }
            }
        }
        $this->getNav();
        echo $this->render('pages/products/add_p');

    }

    //Produkt bearbeiten Action
    public function bearbeitenAction()
    {
        if (isset($_POST['aendern']))
        {
            $this->updateProduct();
        }elseif(isset($_POST['datei']))
        {
            $this->updateFile();
        }



        $this->getNav();
        $resource = new ProduktMdl();
        $produkteArray = $resource->getProduktById($_GET['id']);
        echo $this->render('pages/products/updateProduct',array('produkteArray'=>$produkteArray));
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
	    $menge = $_POST['menge'];
	  
	 
	    //Zuweisung werte
		$produkt = new \Model\ProduktMdl();
		$produkt->setNameDe($name_de);
		$produkt->setNameEn($name_en);
		$produkt->setBeschreibungDe($beschreibung_de);
		$produkt->setBeschreibungEn($beschreibung_en);
		$produkt->setPreis($preis);
		$produkt->setDateiname($dateiname);
		$produkt->setMenge($menge);
		//In Datenbank schreiben
		$resource = new ProduktMdl();
		return $resource->insertProdukt($produkt);
		
	 
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
    	//Wert des Formular-Buttons Beispiel: "Dateiname"
    	$edit = $_POST['aendern'];
    	//Produkt-Id
    	$id = $_GET['id'];
    	$resource = new ProduktMdl();
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
 			$id = $_GET ['id'];
    		$resource =new ProduktMdl();
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
	