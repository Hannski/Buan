<?php

/* In dieser Datei werden Url-Parameter geprüft und entsprechend verarbeitet. */
use \Controller\AdminCtrl;
use \Controller\ProduktCtrl;
use \Controller\CartCtrl;
use View\View;
class Router extends App
{

  public $lang = array();

public function __construct()
{

 include BASEPATH."/app/includes/languageCheck.php";
 $this->lang = array_merge($this->lang,$langArray);
}
//Url verarbeiten
public static function checkUrl($langArray)
{
if(isset($_GET['url']))
 {
//Abgfrage der Werte 'x' : Server/Projektname/x
 $urlArray = explode('/', $_GET['url']);
  /*je nach Url Paramateter 'x' an der Stelle "0" im Url Array, Controller und Templates laden*/
  switch ($urlArray[0])
 {
   case 'user-login':
   $view = new View();
   $view->userlogin();
   $view->footer();
   break;
   case ('adminlogin'):
   //url = Buan/adminlogin
   //Template ausgeben 
    $view = new View();
    $view->adminlogin();
    if(App::adminSess()== true)
     {
     //Admin bereits eingeloggt, verweise auf dashboard.
      echo "<script> window.location.href = \"admin-home\"</script>";
     }
    $ctrl = new AdminCtrl();
    $ctrl->loginAdmin();
    $view->footer();
  break;
  case ('admin-home'):
   if (App::adminSess() == true) {
   //Url = Buan/admin-home
   $view = new View();}
   $ctrl = new AdminCtrl();

   //Wenn Admin eingeloggt ist:
   if($ctrl->verifyAdmin() == false)
   {//kein Zugriff, wenn nicht eingeloggt, redirect
   echo "<script> window.location.href = \"adminlogin\"</script>";
   }else
   {
   echo $view->adminDashboard();
   echo $view->adminFooter();
   }
  break;
  case 'admin-home' && $_GET['url'] == "neues-produkt" || "new-product":
  if (App::adminSess() == true) {
   $view = new View();
  echo $view->adminDashboard();
  echo $view->addProducts();
  if (isset($_POST['add_p']))
  {
    //$_FILES statt $_POST laut Empfehlung von https://www.php.net
    $ctrl = new ProduktCtrl();
    $ctrl->addProduct();
    $ctrl->addFile();
    //reset();
  }
  else
  {
    echo "Problems";
  }
}

  else
  {
    // header("location: Buan/");
  }
  
  break;

  default:
  $view = new View();
  echo "404 Fehler";

  $view->footer();
 break;
   } //switch ende
}
else
{
  //Urlrray[0] = "": default = indexView 
  $view = new View();
  $view->home();
  echo ProduktCtrl::showProducts(); 
  if (isset($_POST['to_cart']))
  {
  CartCtrl::addToCart();
  } 
  $view->adminLoginFooter();
}
} /*Ende function CheckUrl*/
}
?>