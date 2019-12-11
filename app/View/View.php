<?php
/*Nachfolgend sind alle Dateipfade fuer verschiedene Templates in funktionen gespeichert, die beliebig aufgerufen werden können. Neue Templates können hier als neue Funktion definiert werden, die vermittlung von Anzeigen findet in /app/Router.php statt */
namespace View;
use \Controller\Captcha;
use App;
class View 
{

	public function header()
	{   
		//HTML Header
		echo App::render('seitenkomponenten/header');
		
	}
	
	public function footer()
	{
		echo App::render('seitenkomponenten/footer');
	}
	public function adminLoginFooter()
	{
		echo App::render('seitenkomponenten/adminloginfooter');
	}

	public function adminFooter()
	{
		echo App::render('seitenkomponenten/adminFooter');
	}


	public function adminlogin()
	{
	 echo App::render('pages/nav');
	 echo App::render('seitenkomponenten/errors');
  	 echo App::render('pages/admin/adminlogin');
	}
	public function adminDashboard()
	{
		 echo App::render('pages/admin/adminNav');
		 echo App::render('pages/admin/adminhome');
	}
     //produkte hinzufuegen Formular
    public function addProducts()
    {
    echo App::render('/pages/products/add_p');
    }
    /*Produkte bearbeiten-Formular (kann je nach Datenbankabfrage beliebig viele "Karten mit Produktdetails anzeigen")*/
    public function editProducts()
    {
    	
    	echo App::render('pages/products/editp');
    }
    /*Navigation*/
	public function nav()
	{
	echo App::render('pages/nav');
	}
	public function userLogin()
	{
	echo App::render('pages/user/user-login');
	}

}
