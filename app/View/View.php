<?php
namespace View;
use App;
class View 
{
	function __construct()
	{   
		echo App::render('seitenkomponenten/header.php',array());
		echo App::render('pages/nav.html',array());
	}
	/*alle Template-funktionen "t_" für "template"*/
	public function footer()
	{
		echo App::render('seitenkomponenten/footer.php',array());
	}
	public function adminLoginFooter()
	{
		echo App::render('seitenkomponenten/adminloginfooter.php',array());
	}

	public function adminFooter()
	{
		echo App::render('seitenkomponenten/adminFooter.php',array());
	}


	public function adminlogin()
	{
   
   echo App::render('/pages/adminlogin.php',array());
	}
	public function adminDashboard()
	{
		 echo App::render('/pages/adminhome.php',array());
	}

	public function home()
	{

	}
}
?>