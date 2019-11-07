<?php
		/*	
		Spachwahl ueber Buttonklick in der Navigationsleiste pruefen
		*/
	
/*ist eine Sprachwahl breits erfolgt und keine Neuwahl:*/
		if(isset($_SESSION['language']) && !isset($_POST['language']))
		{
			$_SESSION['language'] == $_SESSION['language'];
			include 'language/'.$_SESSION['language'].".php";
		}
		elseif(isset($_POST['language']))
			{
				/* erfolgt eine Erstwahl: */
		switch ($_POST['language']){
			case $_POST['language'] = "en":
				$_SESSION['language'] = $_POST['language'];
				
				include 'language/en.php';
				
				break;
			case $_POST['language'] = "de":
				$_SESSION['language'] = $_POST['language'];
				
				include 'language/de.php';
				
				break;
		}
		}
		else
		{
			/* Standardwahl: Deutsche Sprache*/
			include 'language/de.php';
			
		}
			
	