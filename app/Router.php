<?php

/* In dieser Datei werden Url-Parameter geprüft und entsprechend verarbeitet. */
class Router extends App
{
protected $_templateDatei  = null;
public function __construct()
{
require "./app/languageCheck.php";
include_once 'config.php';
if(isset($_GET['url']))
 {
 $urlArray = explode('/', $_GET['url']);
//je nach Url Paramatetern, Controller und Templates laden
 switch ($urlArray[0])
 {
    //url = Buan/adminlogin
   //AdminLogin
   case ('adminlogin'):
   //Wenn klasse existiert: Inhalte anzeigen, sonst 404 fehler
   if (class_exists('\Controller\Admin')) {

   echo $view = App::render('admin.html', array());
   //isPost aus app/App.php
   if ($this->isPost())
   {
    //controller instanzieren
   $admin = new \Controller\Admin();
   //Login funktion gibt Fehlermeldungen in einem Array zurueck, vergleicht Daten in DB
   $admin->login($_POST['name'],$_POST['password']);
   if (!empty($admin->errorArray))
   {
    foreach ($admin->errorArray as $value)
    {
    //Fehler ausgeben
    echo $langArray[$value];
    }
   }
   else
   {
    //Anmeldung erfolgreich, weiterleiten zum Admin dashboard
    header("Location: adminhome");

   }
 }else
 {
  //TODO: 404 Fehler
  echo "no";
 }
  }
   break;
   //Url = Buan/admin-home
   case ('adminhome'):
   include('View/templates/adminhome.html');
   echo "string";
  echo "<h1>nice</h1>";
   break;

   } //switch ende
}
 }

}
	