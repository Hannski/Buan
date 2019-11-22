<?php

/* In dieser Datei werden Url-Parameter geprüft und entsprechend verarbeitet. */
use \Controller\AdminCtrl;
use View\View;
class Router extends App
{

public function __construct()
{


}

//Url verarbeiten
public static function checkUrl($langArray,$opt)
{
if(isset($_GET['url']))
 {
//Abgfrage der Werte 'x' : Server/Projektname/x
 $urlArray = explode('/', $_GET['url']);
  /*je nach Url Paramateter 'x' an der Stelle "0" im Url Array, Controller und Templates laden*/
  switch ($urlArray[0])
 {
   case ('adminlogin'):
   //url = Buan/adminlogin
   //Wenn klasse existiert: Inhalte anzeigen, sonst 404 fehler
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
   //Url = Buan/admin-home
   $view = new View();
   $ctrl = new AdminCtrl();
   //Wenn Admin eingeloggt ist:
   if($ctrl->verifyAdmin() == false)
   {//kein Zugriff, wenn nicht eingeloggt, redirect
   
   echo "<script> window.location.href = \"adminlogin\"</script>";
   }else
   {
   echo $view->adminDashboard();
     $view->adminFooter();
   }
  break;
  case 'admin-home' && $_GET['url'] == $langArray[$opt]['p_einstellen']:
  echo "hello from produkte";
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
  $view->adminLoginFooter();
}
} /*Ende function CheckUrl*/
}
?>