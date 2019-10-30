<?php
include 'languageCheck.php';
		/*
		Style ueber Buttonklick in der Navigationsleiste pruefen
		*/
		
		if(!isset($_SESSION['style']))
		{
			/* Standardwahl: Heller Modus*/
			
			$_SESSION['style']= $langArray[0]['styleLight'];
		}
		elseif(isset($_POST['style']))
			{
				/* erfolgt eine Erstwahl: */
		switch ($_POST['style']){
			case $_POST['style'] = "dark":
				$_SESSION['style'] = $_POST['style'];
		
				break;
			case $_POST['style'] = "light":
				$_SESSION['style'] = $_POST['style'];
				
				
				
				break;
		}
		}
		