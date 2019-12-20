<?php
/* In dieser Datei werden Url-Parameter geprüft und entsprechend verarbeitet. */
use \Controller\AdminCtrl;
use \Controller\ProduktCtrl;
use \Controller\CartCtrl;
use \Controller\UserCtrl;
// use \Controller\Captcha;
use View\View;
/*DEBUGGING*/
//echo $_SESSION['admin'];
//echo $_SESSION['adminId'];
//echo $_SESSION['super'];
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
   case $url[1]== "user-login":
    View::header();
    View::nav();
    View::enterSite();
    View::userlogin();
    View::footer();
   break;
   case $url[1]=="user-register":
   
    //POST- verarbeitung und ggf. header-weiterleitung.
    if (isset($_POST['u_register']))
    {
      //tryRegisterUser = Formular-Fehler abfangen
      if(UserCtrl::RegisterUserForm()==true)
        {
          /*keine Fehler: Userdaten in die Datenbank schreiben, User muessen jedoch erst durch einen Admin anerkannt werden und sind vorerst gesperrt.*/
          UserCtrl::registerUser();
          $_SESSION['message']="Anfrage wurde gesendet";
        }
    }
    //Ausgabe Inhalte
    View::header();
    View::nav();
    View::enterSite();
    View::errors();
    View::userRegister();
    View::footer();
   
   break;

 //Produkteansich: Nur aufrufbar wenn ein authorisierter Nutzer eingeloggt ist:

   case $url[1] =='produkte':
    View::header();
    View::nav();
    //Anzeige:
    /*Alle Produktinformationen aus der Datenbank wo Lagerbestände positiv sind und nicht gesperrt*/
    echo App::renderData('home', ProduktCtrl::showProducts());
   break;

  /*
  *Admin Login-Formular
  */
   case ($url[1] =='adminlogin'):
   //url = Buan/adminlogin
   if(AdminCtrl::returnAdminStatus())
    {
     //Admin oder Superadmin bereits eingeloggt, verweise auf dashboard.
     header("Location:./admin-home");
     }else{
    if(isset($_POST['a_login']))
    {
      if(AdminCtrl::adminLoginForm())
      {
      $_SESSION['admin'] = "loggedIn";
      header("Location:./admin-home");
      }
    }
    //ansicht: admin-login formular
    View::header();
    View::adminlogin();
    View::footer();
   }
  break;


  /*
  *Admin Bereich
  *Hier ist zu unterscheiden zwischen SuperAdmin und Admins
  *Der Superadmin besitzt als einziger die Rechte: 
  *       -Administratoren hinzuzufuegen
  *       -Administratoren zu sperren
  *       -Administartorendaten anzupassen (Vorname,Nachname (Bsp.: bei Heirat, Namensaenderung), neues Passwort)
  *       -Die eigenen Daten anzupassen (reguläre Administratoren muessen Admin kontaktieren und Aenderungen erfragen)
  */

  /*
  *Admin Dashboard
  */
  case $url[1] =='admin-home' && !isset($url[2]):
   if (!AdminCtrl::returnAdminStatus())
    {
   //Url = Buan/admin-home
   //Wenn Admin eingeloggt ist:
  /*Weiterleitung zu index.php falls Admin nicht eingeloggt*/
    header("Location:./");} 
   else
   {
  $function = AdminCtrl::returnAdminStatus();
  View::header();
  View::$function();
  View::adminFooter();
   }
  break;


 /*
 *Adminbereich> ProdukteVerwaltung> Produkte hinzufuegen
 */

 //Url = Buan/neues-produkt
  case $url[1] =="neues-produkt":
  /*Weiterleitung falls Admin nicht eingeloggt*/
  if (!AdminCtrl::returnAdminStatus())
    {
   //Url = Buan/admin-home
   //Wenn Admin eingeloggt ist:
  /*Weiterleitung zu index.php falls Admin nicht eingeloggt*/
    header("Location:./");} 
   else
   {/*Admin eingeloggt: Inhalte anzeigen*/
  $function = AdminCtrl::returnAdminStatus();
  View::header();
  View::$function();
  View::addProducts();
   //Formdaten per Post-request uebergeben an Produktctrl
  //hier wird $_FILES['file']fuer input type=file uebergeben statt $_POST['file'] laut Empfehlung von https://www.php.net
    if (isset($_POST['add_p']))
   {
    $ctrl = new ProduktCtrl();
    $ctrl->addProduct();
    $ctrl->addFile();
    reset();
    }
  }
  View::footer();
  break;
  
 /*
  * 
 *Adminbereich> ProdukteVerwaltung> Produkte bearbeiten(Alle Vorhandenen Produkte anzeigen)
 */
  case $url[1] =="produkte-bearbeiten" && !isset($_GET['id']) && !isset($url[2]):
  if(App::adminSess() == false)
  { /*Weiterleitung falls Admin nicht eingeloggt*/
    header("Location:./");}
  else
  {
    View::header();
    View::adminDashboard();
    /*alle produkte anzeigen, unabhaengig von bestand und sperrstatus*/
    echo App::renderData('editp', ProduktCtrl::showAdminProducts());
    View::footer();
  }
  break;
   /*
  * 
 *Adminbereich> ProdukteVerwaltung> Eizelnes Produkt bearbeiten
 */
  case $url[1] =="produkt-bearbeiten" && isset($_GET['id']):
   if(App::adminSess() == false)
  { /*Weiterleitung falls Admin nicht eingeloggt*/
    header("Location:./");}
    else
    {
  /* Templates rendern, POST/GET verarbeiten und zugehoerige header vor Ausgabe der Templates verarbeiten */
  /*Javascript vermeiden: jedes input-Feld bekommt ein eigenes Formular. jeweils die id und der neue Wert des zu aktualisierenden Produktes und werden uebergeben. Alle formulare werden mit einem Button "aendern" gesendet welcher jedoch je nach feld eine andere Value zugeschrieben bekommt. Der ProductCtr verarbeitet die aktualisierung eines Tupels in der Dataenbank je nach Wert des Buttons nach dem Prinzip: wenn Name_deutsch geändert wird: ändere name_de in DB und aktualisiere die Seite: der Nutzer kann so ohne Javascript in "Echtzeit" seine aenderngen einsehen.
  $_POST['datei'] = eigenes Formular mit enctype für $_FILES uebertragung.
    */
   if (isset($_POST['aendern']))
  { 
  //Update in der Datenbank
   ProduktCtrl::updateProduct();
   //Seite aktualisieren
   header("Refresh:0");
  }
  if (isset($_POST['datei']))
  { //Datei Aktualisieren
    //Datei aus Asset ordner loeschen und neues Bild kopieren, Dateinamen in Datenbank anpassen
    ProduktCtrl::updateFile();
    //header("Refresh:0");
  }
  //Templates rendern
  View::header();
  View::adminDashboard();
  //alle produkte anzeigen, unabhaengig von bestand und sperrstatus
  echo App::renderData('/products/updateProduct', ProduktCtrl::showProductById($_GET['id']));
  View::footer();
 }
  break;

 /*
 * 
 *Adminbereich> Nutzerverwaltung> User authorisieren
 *
 */
 case $url[1]=="user-authorisierung":
 /*Weiterleitung zu index.php falls Admin nicht eingeloggt*/
 if(!AdminCtrl::returnAdminStatus())
  {  header("Location:./");}
  else
    {
      $function = AdminCtrl::returnAdminStatus();
      View::header();
      View::$function();
      View::errors();
      /*unathorisierte User aus der Datenbank anzeigen: diese sind einzigartig durch kein festgelegtes Erstanmeldedatum */
      echo App::renderData('/admin/listUsers', UserCtrl::showUnauthUsers());
      /*Wenn checkbox+submit button: Nutzer authorisieren und in DB: Nutzer auf entsperrt setzen
      * Erfolg: Meldung an Admin.
      */
      UserCtrl::authUser();
    }
 break;
/*
 * 
 *Adminbereich> Nutzerverwaltung> User-Verwalten
 *
 */
case $url[1]=="nutzer-verwalten":
   if (!AdminCtrl::returnAdminStatus())
    {
   //Url = Buan/admin-home
   //Wenn Admin eingeloggt ist:
  /*Weiterleitung zu index.php falls Admin nicht eingeloggt*/
    header("Location:./");} 
   else
   {
      $function = AdminCtrl::returnAdminStatus();
      View::header();
      View::$function();
      View::errors();
      /*unathorisierte User aus der Datenbank anzeigen: diese sind einzigartig durch kein festgelegtes Erstanmeldedatum */
      echo App::renderData('/admin/editUsers', UserCtrl::showAllUsers());
      View::adminFooter();
    }
break;

/*Adminbereich>Nutzer-verwaltung>Nutzer-bearbeiten*/
case $url[1]=="nutzerdaten-bearbeiten" && isset($_GET['id']):
  if (!AdminCtrl::returnAdminStatus())
    {
   //Url = Buan/admin-home
   //Wenn Admin eingeloggt ist:
  /*Weiterleitung zu index.php falls Admin nicht eingeloggt*/
    header("Location:./home");} 
   else
   { 
   
      $function = AdminCtrl::returnAdminStatus();
      View::header();
      View::$function();
      View::errors();
  /* Templates rendern, POST/GET verarbeiten und zugehoerige header vor Ausgabe der Templates verarbeiten */
  /*Javascript vermeiden: jedes input-Feld bekommt ein eigenes Formular. jeweils die id und der neue Wert des zu aktualisierenden Produktes und werden uebergeben. Alle formulare werden mit einem Button "aendern" gesendet welcher jedoch je nach feld eine andere Value zugeschrieben bekommt. Der ProductCtr verarbeitet die aktualisierung eines Tupels in der Dataenbank je nach Wert des Buttons nach dem Prinzip: wenn Name_deutsch geändert wird: ändere name_de in DB und aktualisiere die Seite: der Nutzer kann so ohne Javascript in "Echtzeit" seine aenderngen einsehen.
  $_POST['datei'] = eigenes Formular mit enctype für $_FILES uebertragung.
    */
  View::updateUser();
   if (isset($_POST['aendern']))
  { 
  //Update in der Datenbank
   ProduktCtrl::updateProduct();
   //Seite aktualisieren
   header("Refresh:0");
  }

 }
 break;
/*
 * 
 *Adminbereich> Nutzerverwaltung> Administratoren-Verwalten und hinzufuegen
 *
 */
 case $url[1]=="admin-erstellen":
 if(App::adminSess() == false)
  {  header("Location:./");}
  else
    {
 if(isset($_POST['addAdmin']))
  {
    if(AdminCtrl::addAdminForm()==true)
    {
    AdminCtrl::addAdmin();
    $_SESSION['message']="suceess";
    }
  }

 View::header();
 View::adminNav();
 View::errors();
 View::addAdmins();
 View::footer();
}
 break;
 case $url[1]=="admin-verwaltung":
  View::header();
 View::adminNav();
 View::errors();
echo App::renderData('/admin/listAdmins', AdminCtrl::showAllSubAdmins());
View::footer();
break;
  default:
  //Wenn keine der obeber Faelle zutrifft: Standardausgabe: Fehlerseite
  echo "404-fehler";
  View::footer();
 break;
   } //switch ende
}
else
{
  //$url[0] = "": default = index.php wird aufgerufen 
    View::header();
    View::nav();
    View::enterSite();
    View::footer();
}

} /*Ende function CheckUrl*/
} /*Ende Klasse*/
?>