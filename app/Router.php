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

 switch ($urlArray[0])
 {

   //AdminLogin
   case ('adminlogin' && class_exists('\Controller\AdminCtrl')):
  
   if (isset($_POST['a_login']))
   {
   $admin = new \Controller\AdminCtrl();
   $admin->name = $_POST['name'];
   $admin->pw   = $_POST['password'];
   $admin->loginA($admin->name,$admin->pw);
   if ($admin->login($admin->name,$admin->pw) !== true)
   {
      echo $langArray[$admin->login($admin->name,$admin->pw)];
   };

   }
   
   include_once 'View/templates/adminlogin.html';
   break;

    
   
   } //switch ende
}
 }

}
	