<?php

namespace Controller;

use Controller\CheckoutCtrl;
use Form\PwRecoveryForm;
use Form\UserAdressForm;
use Form\UserDataForm;
use Form\UserNewPasswordForm;
use Model\ProduktMdl;
use Model\Resource\AdressMdl;
use Model\Resource\BestellungenMdl;
use Model\Resource\CheckoutMdl;
use \Model\Resource\UserMdl;
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
        if ($this->isPost("u_register")) {
            $form = new UserRegisterForm();
            $errorArray = $form->getErrorList();
            if (!empty($errorArray)) {
                //Formularfehler
                echo $this->render('seitenkomponenten/errors', array("errorArray" => $errorArray));
            } //Username noch nicht Vorhanden:
            elseif ($this->canUserRegister()) {
                $this->registerUser();
            } //Username bereits Vorhanden
            elseif (!$this->canUserRegister()) {
                $errorArray[] = "nameTaken";
                echo $this->render('seitenkomponenten/errors', array("errorArray" => $errorArray));
            }

        }
        echo $this->render('pages/user/userRegistration');
        echo $this->render('seitenkomponenten/footer');
    }

    //gibt es den USernamen schon
    public function canUserRegister()
    {
        if (UserMdl::isUsername($_POST['username'])) {
            return false;
        } else {
            return true;
        }
    }

    //einzelnen USer bearbeiten
    public function bearbeitenAction()
    {
        $this->getNav();
        $resource = new UserMdl();
        $userArray = $resource->getUserById($_GET['id']);
        echo $this->render('pages/admin/updateUser', array('userArray' => $userArray));
    }


    /*
    *  Buan/user-login
    * user anmeldung
    */
    public function loginAction()
    {
        if ($this->isPost("userLogin")) {
            $form = new UserLoginForm();
            $errorArray = $form->getErrorList();

            if (!empty($errorArray)) {
                //Formularfehler
                echo $this->render('seitenkomponenten/header');
                echo $this->render('pages/user/UserNav');
                echo $this->render('seitenkomponenten/errors', array("errorArray" => $errorArray));
                echo $this->render('pages/user/user-login');
            } //keine Fehler-> in der DB User authentifizieren
            elseIf ($this->authenticateUser()) {
                $user = $this->authenticateUser();
                //User authentifiziert aber gesperrt?
                if ($user->getStatus() == 1) {
                    //anzeige
                    $errorArray[] = 'gesperrt';
                    echo $this->render('seitenkomponenten/header');
                    echo $this->render('pages/user/UserNav');
                    echo $this->render('seitenkomponenten/errors', array("errorArray" => $errorArray));
                } else {
                    $_SESSION['user'] = "loggedIn";
                    $_SESSION['username'] = $user->getUsername();
                    $_SESSION['userId'] = $user->getId();
                    //alles in Ordnung: weiter zum Dashboard
                    header('Location: user-home');
                }
            } else {
                //Authetifizierung Fehlgeschlagen, pw oder username nicht gefunden:
                echo $this->render('seitenkomponenten/header');
                echo $this->render('pages/user/UserNav');
                $errorArray[] = 'nameNot';
                echo $this->render('seitenkomponenten/errors', array("errorArray" => $errorArray));
                echo $this->render('pages/user/user-login');
            }

        } //Post nicht gesetzt
        else {
            echo $this->render('seitenkomponenten/header');
            echo $this->render('pages/user/UserNav');
            echo $this->render('pages/user/user-login');
        }
    }


    //User hat passwort vergessen:neues Passwort beantragen:
    /*
     * Es soll eine vergabe ienes Vorruebergehend gueltigen Passwortes per Email-Versandt simuliert werden.
     * In diesem Fall werden folgende, normalerweise ueblichen, schritte nicht ausgefuehrt:
     *      1. gueltigkeitszeitraum des vorruebergehenden Passwortes, gueltigkeit wird aufgehoben, wenn es genutzt wurde
     *      2. keine Email mit im POST-Feld, da in diesem Simulationsfall nicht notwendig
     *      3. Versandt der Email kann getstet werden: dazu eine Mailadresse in die Variable $mail schreiben.
     * */
    public function recoveryAction()
    {
        if ($this->isPost('forgotPw'))
        {
        //Fehlerausgabe: wenn keine eingabe:
        $form = new PwRecoveryForm();
        $errorArray = $form->getErrorList();
        if (!empty($errorArray))
        {
            $this->getNav();
            echo $this->render('seitenkomponenten/errors', array("errorArray" => $errorArray));
            echo $this->render('pages/user/pw_recovery');
        }
        //keine Fehler
            //gibt es diesen Usernamen?
            $user= new UserMdl();
           if($user->isUsername($_POST['username']))
            {
                //ja?
                //neues PAsswort generieren
                $recPass= $this->generateRecoveryPassword();
                //temporaeres pw in die Db
                $user->insertTempPw($recPass,$_POST['username']);
                //user mit diesem username sperren
                $user->lockUsername($_POST['username']);
                // Email generieren und- versenden
                //TODO:: EMail!
                //$mail = ?
                //$this->sendRecovery($mail,$recPass,$_POST['username']);
                //Link fuer temp. Passwort (oeffnet in neuem Tab)
                $this->getNav();
                $recoveryArray['username']=$_POST['username'];
                $recoveryArray['pass']=$recPass;

                echo $this->render('pages/user/recoveryPage', array("recoveryArray" => $recoveryArray));
            }else
            {
                $errorArray[] = 'usernameNope';
                $this->getNav();
                echo $this->render('seitenkomponenten/errors', array("errorArray" => $errorArray));
                echo $this->render('pages/user/pw_recovery');
            }

        }else
        {
            $this->getNav();
            echo $this->render('pages/user/pw_recovery');
        }
    }

    //randomisiertes Apsswort erzeugen fuer den PAsswort vergessen-Vorgang
    public function generateRecoveryPassword():string
    {
        //erwuenschte Zeichen
        $characters = 'ABCDEFGHIJKLMNOPQRSTUWXYZabcdefghijklmnopqrstuvwxyz123456789';
        /*substr: Gibt einen Teil eines Strings zurück, str_shuffle: mischt Zeichen im String nach dem Zufallsprinzip*/
        return $recPass = substr(str_shuffle($characters), 0, 7);

    }

    //User-Logout
    public function logoutAction()
    {
        //gibt es einen Warenkorb?
        $cart = new CheckoutMdl();
        if ($cart->isCart($_SESSION['userId'])) {
            //ja?:
            //Produktbestaende wieder in 'items'-tabelle aktualisieren(bestand + reservierte Produktmenge aus warenkorb)
            $cart->fixItemStock($_SESSION['userId']);
            //Warenkorb des Users loeschen
            $cart->deleteSessionCart($_SESSION['userId']);
        }
        //nein: nur abmelden
        //User-Sessionvariablen leeren
        if (isset($_SESSION['user'])) {
            $_SESSION['user'] = '';
            $_SESSION['username'] = '';
            $_SESSION['userId'] = '';
        }
        //header-weiterleitung auf stratseite nach 5 sekunden
        header("refresh:5;url=./");
        //Anzeige
        $this->getNav();
        echo $this->render('pages/alerts/logout');
    }

    //passwort aendern
    public function passwortAction()
    {   //model
        $user = new UserMdl();
        $userArray = $user->getUserById($_SESSION['userId']);
        //post verarbeiten
        if ($this->isPost('password')) {
            //Fehler abfangen
            $form = new UserNewPasswordForm();
            $errorArray = $form->getErrorList();
            if (!empty($errorArray)) {
                $this->getNav();
                //Formularfehler
                echo $this->render('seitenkomponenten/errors', array("errorArray" => $errorArray));
                echo $this->render('pages/user/updateUserPassword', array('userArray' => $userArray));
            } elseif (!$user->isPassword($_POST['passwortAlt'], $_SESSION['userId'])) {
                $errorArray[] = 'pwNope';
                $this->getNav();
                //Formularfehler
                echo $this->render('seitenkomponenten/errors', array("errorArray" => $errorArray));
                echo $this->render('pages/user/updateUserPassword', array('userArray' => $userArray));
            } else {
                //alles ok, ab in die db
                $user->updatePasswort($_POST['passwortNeu'], $_SESSION['userId']);
                //Formular zuruecksetzen
                unset($_POST['password']);
                header("refresh: 2");
                //gute nachrichten
                $errorArray[] = 'changeSuccess';
                //anzeige
                $this->getNav();
                echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
                echo $this->render('pages/user/updateUserData', array('userArray' => $userArray));
            }

        } else {
            $this->getNav();
            echo $this->render('pages/user/updateUserPassword', array('userArray' => $userArray));
        }
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
        if ($this->isPost('auth') && isset($_POST['status'])) {
            $resource->authUser($_POST['id'], $_POST['status']);
        }
        $this->getNav();
        $resource = new UserMdl();
        $userArray = $resource->getUnauthUsers();
        if (empty($userArray)) {
            $errorArray = array();
            $errorArray[] = 'noRegisterReq';
            echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
        } else {
            echo $this->render('pages/admin/listUsers', array('userArray' => $userArray));
        }

        echo $this->render('seitenkomponenten/footer');

    }

    //einzelne Nutzerdaten  verwalten
    public function verwaltenAction()
    {
        $this->getNav();
        $resource = new UserMdl();
        $userArray = $resource->getAllAuthUsers();
        echo $this->render('pages/admin/editUsers', array('userArray' => $userArray));
    }

    //Gibt bei passendem Eintrag in db ein User-Objekt zurück sonst false;
    public function authenticateUser()
    {
        return UserMdl::authenticateUser($_POST['username'], md5($_POST['password']));
    }

    /*USer Homeansicht:
    -wenn user eingeloggt:
    -User Navigationsleiste (abmelden, passwort Aendern etc.)
    -Artikel in den Warenkorb legen
    */
    public function homeAction()
    {
        if ($this->isPost('toCart')) {
            $cart = new CheckoutCtrl();
            //Wenn warenkorb leer:insert, sonst::update
            $cart->addToCart();
        }
        $this->getNav();
        $produkte = new \Controller\ProduktCtrl();
        echo $this->render('pages/home', $produkte->showProducts());
        echo $this->render('seitenkomponenten/footer');

    }


    //eigenen Username aendern
    public function datenAction()
    {
        //TODO::errorReporting
        //error_reporting(0);
        //Model
        $user = new UserMdl();
        $userArray = $user->getUserById($_SESSION['userId']);
        //Post verarbeiten
        if ($this->isPost('userName')) {
            //Fehler?
            $form = new UserDataForm();
            $errorArray = $form->getErrorList();
            if (!empty($errorArray)) {
                //Anzeige
                $this->getNav();
                echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
                echo $this->render('pages/user/updateUserData', array('userArray' => $userArray));
            } //USername bereits vergeben?
            elseif ($user->isNewUsername($_POST['username'], $_SESSION['userId'])) {
                $errorArray[] = 'nameTaken';
                $this->getNav();
                echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
                echo $this->render('pages/user/updateUserData', array('userArray' => $userArray));
            } else {
                //keine Fehler -> update in Db
                $user->updateUsername($_POST['username'], $_SESSION['userId']);
                //formular zuruecksetxen
                unset($_POST['userName']);
                //seite aktualisieren
                header("refresh:2");
                //gute nachrichten
                $errorArray[] = 'changeSuccess';
                //anzeige
                $this->getNav();
                echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
                echo $this->render('pages/user/updateUserData', array('userArray' => $userArray));
            }
        } else {
            //Anzeige
            $this->getNav();
            echo $this->render('pages/user/updateUserData', array('userArray' => $userArray));
        }


    }

    //Adressdaten anpassen
    public function adresseAction()
    {
        //FehlerFormular
        $form = new UserAdressForm();
        $errorArray = $form->getErrorList();
        //Model
        $address = new AdressMdl();
        //bereits eine Adresse eingegeben?
        //update bei POST
        if ($address->isaddress($_SESSION['userId'])) {
            if ($this->isPost('adresse')) {
                if (!empty($errorArray)) {
                    $this->getNav();
                    echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
                } else {
                    $address->updateAddress();
                    //aktualisieren
                    header("refresh:2");
                    //anzeige
                    $this->getNav();
                    //gute neuigkeiten
                    $errorArray[] = 'changeSuccess';
                    echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
                }

            }
            $this->getNav();
            $addressArray = $address->getUserAddress($_SESSION['userId']);
            echo $this->render('pages/user/updateUserAdress', array('addressArray' => $addressArray));
        }
        //neue Adresse:
        //Insert bei POST
        else {
            if ($this->isPost('adresse')) {
                //Fehler?
                if (!empty($errorArray)) {
                    $this->getNav();
                    echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
                } else {
                    //alles ok? ab in die DB
                    $address->insertAddress();
                    //aktualisieren
                    header("refresh:2");
                    //anzeige
                    $this->getNav();
                    //gute neuigkeiten
                    $errorArray[] = 'changeSuccess';
                    echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));


                }
            }
            $this->getNav();
            echo $this->render('pages/user/updateUserAdress');

        }


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
        return array('userArray' => $userArray);
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
        return array('userArray' => $userArray);
    }

    //Bestellungen einsehen
    public function bestellungenAction()
    {
        $this->getNav();
        // gibt es zu diesem User bereits bestellungen?
        $resource = new BestellungenMdl();
        if ($resource->isOrders()) {
            // array mit validen betselljahren und monaten fuer auswahlfeld auf clientseite
            $orderArray = $resource->getUserOrderDates();
            echo $this->render('pages/bestellungen/user-bestellungen', array('orderArray' => $orderArray));

            //User waehlt ansicht ueber select/option feld aus
            if ($this->isPost('seeOrders')) {
                //Post gibt Datum und Monat im Format '0000-00' zurueck.
                // formatieren:
                //debugging:  echo $_POST['jahrMonat'];
                $datum = explode('-', $_POST['jahrMonat']);
                $jahr = $datum[0];
                $monat = $datum[1];

                $array = $resource->getBestellungen($monat, $jahr);
                //var_dump($array);
                foreach ($array as $value) {
                    $arrayNEw = explode('-', $value);
                    var_dump($arrayNEw);
                }
                echo $this->render('pages/bestellungen/user-bestellungen-anzeigen', array('orderArray' => $array));


            }
        } else {
            $errorArray = array();
            $errorArray[] = 'noOrders';
            echo $this->render('pages/seitenkompnenten/errors', array('errorArray' => $errorArray));
        }
    }


}