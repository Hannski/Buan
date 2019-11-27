<?php
namespace View;
use App;
class View 
{
	function __construct()
	{   
		echo App::render('seitenkomponenten/header',array());
		echo App::render('pages/nav',array());
	}
	/*alle Template-funktionen "t_" für "template"*/
	public function footer()
	{
		echo App::render('seitenkomponenten/footer',array());
	}
	public function adminLoginFooter()
	{
		echo App::render('seitenkomponenten/adminloginfooter',array());
	}

	public function adminFooter()
	{
		echo App::render('seitenkomponenten/adminFooter',array());
	}


	public function adminlogin()
	{
   
   echo App::render('/pages/adminlogin',array());
	}
	public function adminDashboard()
	{
		 echo App::render('/pages/adminhome',array());
	}

    public function addProducts()
    {
    echo App::render('/pages/add_p',array());
    }
	public function home()
	{

	}

}
?>