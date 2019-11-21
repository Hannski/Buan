<?php
		
		/*
		Style ueber Buttonklick in der Navigationsleiste pruefen*/		
		if(!isset($_SESSION['style']))
		{   
			/* Standardwahl: Heller Modus, mit Standardsprache Deutsch*/
			if (!isset($langArray))
			{
				include_once  BASEPATH.'/app/includes/languageCheck.php';
			}

			$_SESSION['style']= $langArray[0]['styleLight'];
		}
		elseif(isset($_POST['style']))
			{
				/* erfolgt eine Erstwahl: */
		switch ($_POST['style']){

				case $_POST['style'] = "dark":
				$_SESSION['style'] = $_POST['style'];
				//Stylesheet "Nachtmodus" einbinden, Auswahl in Session speichern.
        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"./style/customStyles/dark.css\">";
 	
				break;
			case $_POST['style'] = "light":
				//Auswahl von Nachtmodus zu Tagmodus, in Session speichern.
				 $_SESSION['style'] = $_POST['style'];	
			
				break;
		}
		}
		