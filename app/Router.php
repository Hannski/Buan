<?php
/* In dieser Datei werden Url-Parameter geprüft und entsprechend verarbeitet. */
use \Controller\AdminCtrl;
use \Controller\ProduktCtrl;
use \Controller\CartCtrl;
// use \Controller\Captcha;
use View\View;
class Router extends App
{

public $lang = array();
public function __construct()
{
 include BASEPATH."/app/includes/languageCheck.php";
}
//Url verarbeiten
public static function checkUrl()
{
if(isset($_GET['url']))
 {
 //Abgfrage der Werte 'x' : in url = /Projektname/x
 $url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

 $url = explode("/", $url);
  // Debugging: var_dump($url);
/*je nach Url Paramateter 'x' an der Stelle "0" im Url Array, Controller und Templates laden*/
  switch ($url)
 {
   case $url[1] =='user-login':
    View::header();
    View::nav();
    View::userlogin();
    View::footer();
   break;
   case ($url[1] =='adminlogin'):
   //url = Buan/adminlogin
    if(App::adminSess()== true)
     {
     //Admin bereits eingeloggt, verweise auf dashboard.
     header("Location:admin-home");
     }else{
    //ansicht: admin-login formular
    View::header();
    View::adminlogin();
    AdminCtrl::loginAdmin();
    View::footer();
   }
  break;

  case $url[1] =='admin-home' && !isset($url[2]):
   if (App::adminSess() == true)
    {
   //Url = Buan/admin-home
   //Wenn Admin eingeloggt ist:
   if(AdminCtrl::verifyAdmin() == false)
   { /*Weiterleitung falls Admin nicht eingeloggt*/
    header("Location:adminlogin"); 
   }else
   {
    //Admin-Home Ansicht
  View::header();
  View::adminDashboard();
  View::adminFooter();
   }
 }
  break;
  case $url[1] =="neues-produkt":
   //Url = Buan/neues-produkt
  if (App::adminSess() == false)
  { /*Weiterleitung falls Admin nicht eingeloggt*/
   header("Location:adminlogin"); 
  }
  else
  {
  View::header();
  View::adminDashboard();
  View::addProducts();
  if (isset($_POST['add_p']))
  {
    //Formdaten per Post-request uebergeben an Produktctrl
    //hier wird $_FILES['file']fuer input type=file uebergeben statt $_POST['file'] laut Empfehlung von https://www.php.net
    $ctrl = new ProduktCtrl();
    $ctrl->addProduct();
    $ctrl->addFile();
    //reset();
  }
  }
  View::footer();
  break;
  case $url[1] =="produkte-bearbeiten" && !isset($_GET['id']) && !isset($url[2]):
  if(App::adminSess() == false)
  { /*Weiterleitung falls Admin nicht eingeloggt*/
    header("Location:adminlogin");}
  else
  {
    View::header();
    View::adminDashboard();
    /*alle produkte anzeigen, unabhaengig von bestand und sperrstatus*/
    echo App::renderData('editp', ProduktCtrl::showAdminProducts());
    View::footer();
  }
  break;
  case $url[1] =="produkt-bearbeiten" && isset($_GET['id']):
   if(App::adminSess() == false)
  { /*Weiterleitung falls Admin nicht eingeloggt*/
    header("Location:adminlogin");}
    else
    {
  /* Templates rendern, POST/GET verarbeiten und zugehoerige header vor Ausgabe der Templates verarbeiten */
   if (isset($_POST['aendern']))
  { 
    /*
    Javascript vermeiden: jedes input-Feld bekommt ein eigenes Formular. jeweils die id und der neue Wert des zu aktualisierenden Produktes und werden uebergeben. Alle formulare werden mit einem Button "aendern" gesendet welcher jedoch je nach feld eine andere Value zugeschrieben bekommt. Der ProductCtr verarbeitet die aktualisierung eines Tupels in der Dataenbank je nach Wert des Buttons nach dem Prinzip: wenn Name_deutsch geändert wird: ändere name_de in DB und aktualisiere die Seite: der Nutzer kann so ohne Javascript in "Echtzeit" seine aenderngen einsehen.
    */
  //Update in der Datenbank
   ProduktCtrl::updateProduct();
   //Seite aktualisieren
   header("Refresh:0");
  }
  if (isset($_POST['datei']))
  {
    //Datei Aktualisieren
    //Datei aus Asset ordner loeschen und neues Bild kopieren, Dateinamen in Datenbank anpassen
    ProduktCtrl::updateFile();
    // header("Refresh:0");
  }
  //Templates rendern
  View::header();
  View::adminDashboard();
  //alle produkte anzeigen, unabhaengig von bestand und sperrstatus
  echo App::renderData('/products/updateProduct', ProduktCtrl::showProductById($_GET['id']));
  View::footer();
 
 }
  break;
  default:
  //Wenn keine der obeber Faelle zutrifft: Standardausgabe:
  View::footer();
 break;
   } //switch ende
}
else
{
  //$url[0] = "": default = index.php wird aufgerufen 
  View::header();
  View::nav();
  //Anzeige:
  /*Alle Produktinformationen aus der Datenbank wo Lagerbestände positiv sind und nicht gesperrt*/
  echo App::renderData('home', ProduktCtrl::showProducts());
  if (isset($_POST['to_cart']))
  {
  CartCtrl::addToCart();
  } 
  View::adminLoginFooter();
}

} /*Ende function CheckUrl*/
} /*Ende Klasse*/
?>