<?php
	 include BASEPATH.'/language/lang.php';

		/*	
		Spachwahl ueber POST-Buttons in Navigationsleiste /alerts/pages/home.html pruefen
		*/


       /*ist eine Sprachwahl breits erfolgt und keine Neuwahl:*/
		if(isset($_SESSION['language']) && !isset($_POST['language']))
		{
			$_SESSION['language'] == $_SESSION['language'];
			$opt  = $_SESSION['language'];
		}
		elseif(isset($_POST['language']))
			{
				/* erfolgt eine Erstwahl: */
		switch ($_POST['language']){
			case $_POST['language'] = "en":
				$_SESSION['language'] = 1;
				$opt  = $_SESSION['language'];
				
				break;
			case $_POST['language'] = "de":
				$_SESSION['language'] = 0 ;
				$opt  = $_SESSION['language'];
				
				break;
		}
		}
		else
		{
			$_SESSION['language'] = 0;
			$opt  = 0;
			/* Standardwahl: Deutsche Sprache*/
			
		}
			
