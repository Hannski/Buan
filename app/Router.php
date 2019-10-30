<?php

/* In dieser Datei werden Url-Parameter geprüft und entsprechend verarbeitet. */

class Router
{
	
function __construct()
{
require_once 'View/seitenkomponenten/header.php';
require_once 'View/templates/home.html';
require BASEPATH.'/app/Controller/IndexCtrl.php';


echo $langArray[0]['button'];
$index = new IndexCtrl();

 if(isset($_GET['url']))
 {

 $urlArray = explode('/', $_GET['url']);
// Hilfe: print_r($urlArray[0]);
 echo "<br> hi from router ";


 switch ($urlArray[0])
 {

 //UserProfil anzeigen und mit Daten füllen
   
 // case 'profile':
 //   $this->view->message("hello from message");
 //   $this->view->message("hello from message2");
 //   //Neues Spiel starten
 //   if(isset($_POST['neuesSpiel']))
 //    { 
     
 //     header("Location: kategorie");
     //Kategire auswählen
     // url: aa_game/profile/kategorie
    }
    }
    require_once 'View/seitenkomponenten/footer.php';
    }
   
  
}
	