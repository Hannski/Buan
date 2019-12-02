<?php
namespace View;
use App;
class View 
{
	function __construct()
	{   
		//HTML Header
		echo App::render('seitenkomponenten/header');
		
	}
	/*alle Template-funktionen "t_" für "template"*/
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
  	 echo App::render('pages/adminlogin');
	}
	public function adminDashboard()
	{

		 echo App::render('pages/adminNav');
		 echo App::render('seitenkomponenten/errors');
		 echo App::render('pages/adminhome');
	}

    public function addProducts()
    {
    echo App::render('/pages/add_p');
    }
	public function home()
	{
	echo App::render('pages/nav');
	
	}

}
?>