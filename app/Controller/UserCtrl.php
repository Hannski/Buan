<?php
namespace Controller;
use Controller\ProduktCtrl;
use Model\ProduktMdl;
use Model\Resource\BestellungenMdl;
use \Model\Resource\UserMdl ;
use \Form\UserLoginForm;
use \Form\UserRegisterForm;



class UserCtrl extends AbstractController
{


    /*
     * /user-register
     * user-registrierung

	* Nutzer sendet Registrierungsanfrage:
	*-Formularfehler abfangen:
	*		-Felder sind unausgefuellt
	*		-Passwoerter stimmen nicht ueberein
     *      -Passwort zu kurz/lang
     *      -username zu kurz/lang
     *      -username bereits vorhanden
	*
	*/

    public function registerAction()
    {
      $this->getNav();
        if($this->isPost("u_register"))
        {   $form = new UserRegisterForm();
            $errorArray = $form->getErrorList();
            if(!empty($errorArray))
            {
                //Formularfehler
                echo $this->render('seitenkomponenten/errors', array("errorArray" => $errorArray));
            }
            //Username noch nicht Vorhanden:
            elseif ($this->canUserRegister())
            {
                $this->registerUser();
            }
            //Username bereits Vorhanden
            elseif(!$this->canUserRegister())
                    {
                    $errorArray[] = "nameTaken";
                    echo $this->render('seitenkomponenten/errors', array("errorArray" => $errorArray));
                    }

        }
        echo $this->render('pages/user/userRegistration');
        echo $this->render('seitenkomponenten/footer');
    }

    public function canUserRegister()
    {
     if(UserMdl::getUsername($_POST['username'])){return false;}else{return true;}
    }

    //einzelnen USer bearbeiten
    public function bearbeitenAction()
    {
     $this->getNav();
     $resource = new UserMdl();
     $userArray = $resource->getUserById($_GET['id']);
     echo $this->render('pages/admin/updateUser',array('userArray'=>$userArray));
    }



	/*
    *  Buan/user-login
    * user anmeldung
    */
    public function loginAction()
    {   $errorArray = array();
        echo $this->render('seitenkomponenten/header');
        echo $this->render('pages/user/userNav');
        if($this->isPost("loginButton"))
        {   $form = new UserLoginForm();
            $errorArray = $form->getErrorList();
           if(!empty($errorArray)){
               //Formularfehler
            echo $this->render('seitenkomponenten/errors', array("errorArray" => $errorArray));
           }
           //keine Fehler-> in der DB User authentifizieren
           elseIf($this->authenticateUser()){
              $user = $this->authenticateUser();
              //User authentifiziert aber gesperrt?
             if($user->getStatus()==1)
             {
                 $errorArray[] = 'gesperrt';
                 echo $this->render('seitenkomponenten/errors', array("errorArray" => $errorArray));
             }else
                 {
                     $_SESSION['user'] = "loggedIn";
                     $_SESSION['userId'] = $user->getId();
                     //alles in Ordnung? weiter zum Dashboard
                    header('Location: user-home');
             }
              }
           else{
            //Authetifizierung Fehlgeschlagen, pw oder username nicht gefunden:
               $errorArray[] = 'nameNot';
               echo $this->render('seitenkomponenten/errors', array("errorArray" => $errorArray));
           }

        }
        echo $this->render('pages/user/user-login');
        echo $this->render('seitenkomponenten/footer');

    }

    //Nutzer authorisierung

    /*
    *Nutzer authoriesierung:
    *-Formularfehler abfangen,
    *-Datenbankeintrag "user" mit entsprechender ID aendern:
    *	-nicht mehr gesperrt
    *	-authorisierungsdatum speichern
    */
    public function authorisierungAction()
    {
        $resource = new UserMdl();
        if ($this->isPost('auth') && isset($_POST['status']))
    {
        $resource->authUser($_POST['id'],$_POST['status']);
    }
        $this->getNav();
        $resource = new UserMdl();
        $userArray = $resource->getUnauthUsers();
        if(empty($userArray))
        {
            $errorArray = array();
            $errorArray[] = 'noRegisterReq';
            echo $this->render('seitenkomponenten/errors',array('errorArray'=>$errorArray));
        }else{
            echo $this->render('pages/admin/listUsers',array('userArray'=>$userArray));
        }

        echo $this->render('seitenkomponenten/footer');

    }

    //einzelne Nutzerdaten  verwalten
    public function verwaltenAction()
    {
       $this->getNav();
       $resource = new UserMdl();
       $userArray= $resource->getAllAuthUsers();
       echo $this->render('pages/admin/editUsers',array('userArray'=>$userArray));
    }

    //Gibt bei passendem Eintrag in db ein User-Objekt zurück sonst false;
    public function authenticateUser()
    {
        return UserMdl::authenticateUser($_POST['username'], md5($_POST['password']));
    }


    public function homeAction()
    {
        if($this->isPost('toCart')) {

            $cart = new CheckoutCtrl();
            //Funktion regelt: Wenn warenkorb leer:insert, sonst:: update
            $cart->addToCart();
        }
        $this->getNav();
        $produkte = new \Controller\ProduktCtrl();
        echo $this->render('pages/home',$produkte->showProducts());
        echo $this->render('seitenkomponenten/footer');

    }

    //eigene Nutzerdaten anpassen
    public function datenAction()
    {
        $this->getNav();
        $userArray = new UserMdl();
        $userArray = $userArray->getUserById($_SESSION['userId']);
        echo $this->render('pages/user/updateUserData',array('userArray'=>$userArray));
    }

    //Adressdaten anpassen
    //eigene Nutzerdaten anpassen
    public function adresseAction()
    {
        $this->getNav();
        $userArray = new UserMdl();
        $userArray = $userArray->getUserById($_SESSION['userId']);
        echo $this->render('pages/user/updateUserAdress',array('userArray'=>$userArray));
    }

    //uebersicht ueber Zahlungen und Boni+ PDF ausdruck Moeglichkeit
    public function gehaltAction()
    {
        $this->getNav();
        echo $this->render('pages/user/rechnungen');
    }

   /*
    *
    *Nutzer sendet Registrierungsanfrage + keine Formularfehler(Abfrage in Router.php)
     *  Formularfehler abfangen (leeres feld, pw zu kurz/lang, Nutzername bereits Vorhanden)
    *	-gewunschtes pw(verschluesselt) und Username in die DB
    *	-Nutzer vorerst gesperrt(Status=1)
    *	-kein Konfirmationsdatum
    *	-AppMsg = Text, gründe warum Mitglied beitreten will.
    */
	public function registerUser()
	{
	    $user = new \Model\UserMdl();
		$user->setUsername($_POST['username']);
		$user->setPwmd5(md5($_POST['password1']));
		$user->setStatus(1);
		$user->setAppMsg($_POST['msg']);
		//In Datenbank schreiben
		$resource = new UserMdl();
		$resource->insertUser($user);
	}

	/*Anzeige  Unauthoriesierte Nutzer aus DB :
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

    //Bestellungen einsehen
    public function bestellungenAction()
    {
        $this->getNav();

        // gibt es zu diesem User bereits bestellungen?
       $resource = new BestellungenMdl();
      if($resource->isOrders())
      {          // array mit validen betselljahren und monaten fuer auswahlfeld auf clientseite
          $orderArray = $resource-> getUserOrderDates();
          echo $this->render('pages/bestellungen/user-bestellungen',array('orderArray'=>$orderArray));
          //User waehlt ansicht ueber select->ioption feld aus
          if ($this->isPost('seeOrders'))
          {
            //Post gibt Datum und Monat im Format '0000-00' zurueck.
              // formatieren:
             //debugging:  echo $_POST['jahrMonat'];
              $datum = explode('-',$_POST['jahrMonat']);
              $jahr = $datum[0];
              $monat = $datum[1];
              $orderArray = $resource->getOrdersByDate($jahr,$monat);
              echo $this->render('pages/bestellungen/user-bestellungen-anzeigen',array('orderArray'=>$orderArray));
          }
      }else{
          $errorArray=array();
          $errorArray[] = 'noOrders';
          echo $this->render('pages/seitenkompnenten/errors',array('errorArray'=>$errorArray));}
    }


}