<?php
/*
 * Wilkommen im Produkt-Controller. Hier werden alle Anfragen bezueglich der Produkte verarbeitet.
 * Anhand der url, lassen sich die verschiedenen Methoden dieses Controllers aufrufen.
 * Jede Funktion in diesem Controller startet daher mit einer Abfrage, ob der Zugriff genehmigt- oder umgeleitet wird
 * auf eine "kein Zugriff"- Seite.
 * */
namespace Controller;
use \Model\Resource\ProduktMdl ;
use Form\ProduktEinstellenForm;

class ProduktCtrl extends AbstractCtrl
{

    //Produkte verwalten: Diese Funktionalitaet ist Administratoren vorbehalten
    //Anzeige: Uebersicht ueber alle Produkte (einschliesslich gesperrter Produkte)
    // Template: 'pages/products/editp'
    public function verwaltenAction()
    {
        //nur fuer administratoren
        $this->allAdminsOnly();

        //Resourcemodel
        $resource = new ProduktMdl();

        //alle Produkte aus der Datenbank
        $produkteArray = $resource->getAllAdminProducts();

        //Anzeige:
        $this->getNav();
        echo $this->render('pages/products/editp',array('produkteArray'=>$produkteArray));
    }




    //Ein neues Produkt erstellen: Ansicht. Administratoren vorbehalten.
    //Template: 'pages/products/add_p'
    public function erstellenAction()
    {
        //nur fuer administratoren
        $this->allAdminsOnly();

        //ist Post gesetzt?: ja
        if($this->isPost('add_p'))
        {
            //neues Fehlerformular
            $form= new ProduktEinstellenForm();

            //Fehlerliste
            $errorArray = $form->getErrorList();

            //Fehlerarray nicht leer
            if(!empty($errorArray))
            {
                //Fehler anzeigen
                $this->getNav();
                echo $this->render('seitenkomponenten/errors',array('errorArray'=>$errorArray));
                echo $this->render('pages/products/add_p');
            }
            //Fehlerarray leer: ab in die Datenbank
            else
            {
                // Bild hinzufuegen
                $this->addFile();
                //Produkt hinzufuegen
                //hat es geklappt?
                if($this->addProduct())
                {
                    //Anzeige
                    $this->getNav();
                    //gute nachrichten
                    $errorArray [] = 'productYes';
                    echo $this->render('seitenkomponenten/errors',array('errorArray'=>$errorArray));
                    echo $this->render('pages/products/add_p');
                }
                else
                {
                    //etwas ist schief gelaufen: Anzeige
                    $this->getNav();
                    //schlechte nachrichten
                    $errorArray [] = 'dbProblem';
                    echo $this->render('seitenkomponenten/errors',array('errorArray'=>$errorArray));
                }
            }
        }
        //Post ist nicht gesetzt
        else{
            //Anzeige
            $this->getNav();
            echo $this->render('pages/products/add_p');
        }
    }


    //Produkt bearbeiten Action
    public function bearbeitenAction()
    {
        //nur fuer administratoren
        $this->allAdminsOnly();

        if($this->isPost('aendern')) {

            //Alles ausser Bild aendern verarbeiten
            if (isset($_POST['aendern'])) {
                $this->updateProduct();
            }

            //Anzeige
            $this->getNav();
            $resource = new ProduktMdl();
            $produkteArray[]= $resource->getProduktById($_GET['id']);
            echo $this->render('pages/products/updateProduct',array('produkteArray'=>$produkteArray));

        }  //Bild aendern verarbeiten
        elseif
        (isset($_POST['dateiname']))
        {
             $this->updateFile();
             //Anzeige
            //Anzeige
            $this->getNav();
            $errorArray[]="changeSuccess";
            $resource = new ProduktMdl();
            $produkteArray[] = $resource->getProduktById($_GET['id']);
            echo $this->render('seitenkomponenten/errors',array('errorArray'=>$errorArray));
            echo $this->render('pages/products/updateProduct',array('produkteArray'=>$produkteArray));
        }else{
            //Post ist nicht gesetzt: Anzeige
        $this->getNav();
        $resource = new ProduktMdl();
        $produkteArray[] = $resource->getProduktById($_GET['id']);
        echo $this->render('pages/products/updateProduct',array('produkteArray'=>$produkteArray));
        }
    }


    //Produkt in die Datenbank schreiben. Wird aufgerufen von Produkt.bearbeitenAction
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
    //Datei in den Ordner: Projektordner/Assets kopieren. Wird aufgerufen von Produkt.bearbeitenAction
    //Dateipfad ist in der Datenbank hinterlegt.
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


    //einzelnes Produkt bearbeiten
    //ohne unnoetiges Abfangen von Fehlern.
    public function updateProduct()
    {
    	//Wert aller Post-Felder  "aendern", je nach value abfragen
    	$edit = $_POST['aendern'];

    	//Produkt-Id aus URL
    	$id = $_GET['id'];

    	//Resourcemodel
    	$resource = new ProduktMdl();

    	//Name-Deutsch
    	if ($edit=="name_de")
    	{$value=$_POST['name_de'];}
    	//Name-English
    	elseif ($edit=="name_en")
		{ $value = $_POST['name_en'];}
    	//Beschreibung-Deutsch
		elseif($edit=="beschreibung_de"){$value = $_POST['desc_de'];}
    	//Beschreibung-English
		elseif($edit=="beschreibung_en"){$value = $_POST['desc_en'];}
    	//Preis
		elseif($edit=="preis"){$value= $_POST['preis'];}
    	//Bestand
		elseif($edit=="bestand"){$value= $_POST['bestand'];}
    	//Dateiname
		elseif($edit=="dateiname"){$value= $_POST['dateiname'];}
    	//Status (0 oder 1)
		elseif($edit == "gesperrt"){$value= $_POST['gesperrt'];}

    	//Update in der Datenbank
		$resource->UpdateProdukt($id,$edit,$value);
    }


 	// Bild aktualisieen. Bilddatei im Unterordner ggf. ersetzen : "Projektordner/Assets/"
 	public function updateFile()
 	{

 			//Deteinamen in Datenbank Aendern:
            //ID aus der URL
 			$id = $_GET ['id'];

 			//Resourcemodel
    		$resource =new ProduktMdl();
    		//Spalte in der DAtenbank die aktualisiert werden soll
    		$edit= "dateiname";

    		//neur Wert
    		$value = $_FILES['dateiname']['name'];

    		//ab in die Datenbank
    		$resource->UpdateProdukt($id,$edit,$value);

    		//alte Datei in Assetordner loeschen, wenn vorhanden: 
    		if(file_exists(BASEPATH."/Assets/".$_POST['dateiAlt']))
    		{
    		//@: Fehler unterdruecken falls beispielsweise "aktualisieren" mehrmals akiviert wird.
                //Datei die geloescht werden soll
    		$file_to_delete = $_POST['dateiAlt'];
    		//loeschen
			 @unlink(BASEPATH."/Assets/".$file_to_delete);
    		}
   			
    		//Datei in Assetordner kopieren:
    		$this->addFile();
 
    		
 	}

 
}
	