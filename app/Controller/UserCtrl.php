<?php
namespace Controller;
use \Model\Resource\UserMdl ;
use App;
class UserCtrl
{
	/*
	* Nutzer sendet Registrierungsanfrage:
	*-Formularfehler abfangen:
	*		-Felder sind unausgefuellt
	*		-Passwoerter stimmen nicht ueberein
	*
	*/
	public function RegisterUserForm()
	{
		$message="";
		if (empty($_POST['username']) || empty($_POST['password1']) || empty($_POST["password2"])||empty($_POST['msg']))
		{ 
			$message = "Alle Felder muessen ausgefuellt werden";
		}
		elseif($_POST['password1'] !== $_POST["password2"])
		{
			$message="Passwoerter stimmen nicht ueberein";
		}
		if(!empty($message))
		{
		$_SESSION['errors'] = $message;
		}
		else
		{
			$_SESSION['errors']="";
			return true;
		}
	}

	/*
	*
	*Nutzer sendet Registrierungsanfrage + keine Formularfehler(Abfrage in Router.php)
	*	-gewunschtes pw(verschluesselt) und Username in die DB
	*	-Nutzer vorerst gesperrt(Status=1)
	*	-kein Konfirmationsdatum
	*	-AppMsg = Text, gründe warum Mitglied beitreten will.
	*/
	public function registerUser()
	{
		$user = App::getModel('UserMdl');
		$user->setUsername($_POST['username']);
		$user->setPwmd5(md5($_POST['password1']));
		$user->setStatus(1);
		$user->setAppMsg($_POST['msg']);
		//In Datenbank schreiben
		$resource = App::getResourceModel('UserMdl');
		$resource->insertUser($user); 
	}

	/*Anziege  Unauthoriesierte Nutzer aus DB : 
	* - Merkmal: noch kein authorisierungsdatum gespeichert
	*/
	public function showUnauthUsers()
	{
		// resource-model instanzieren
        $model = App::getResourceModel('UserMdl');
        //Unauthorisierte User abrufen
        $userArray = $model->getUnauthUsers();
        // Userarray fuer Anzeige in Array bereitstellen
        return array('userArray'=>$userArray);
	}


	/*
	*Nutzer authoriesierung:
	*-Formularfehler abfangen,
	*-Datenbankeintrag "user" mit entsprechender ID aendern:
	*	-nicht mehr gesperrt
	*	-authorisierungsdatum speichern
	*/
	public function authUser()
	{
		$message ='';
	 if(isset($_POST['auth'])&&isset($_POST['status']))
      {
		$user = App::getModel('UserMdl');
		$user->setStatus($_POST['status']);
		$user->setId($_POST['id']);
		$resource = App::getResourceModel('UserMdl');
		$resource->authUser($user);
		/*Fehlermeldung*/
		$_SESSION['errors']="";
		$_SESSION['message'] = "Nutzer wurde authorisiert";
	   }
		else
		{ /*Meldung an Admin siehe /templates/seitenkomponenten/errors.php*/
			$_SESSION['message']="";
			 $_SESSION['errors']="nope";
		}
	}

	/*abrufen:
	*Alle User die:
	*-authoriesiert sind
	*-unabhaengig von Sperrstatus
	*/
	public function showAllUsers()
	{
		// resource model instanzieren
        $model = App::getResourceModel('UserMdl');
        // Produkte abrufen
        $userArray = $model->getAllAuthUsers();

        // Produkte darstellen / template
        return array('userArray'=> $userArray);
	}

}