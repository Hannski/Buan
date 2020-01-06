<?php

namespace Controller;

use Controller\CheckoutCtrl;
use Form\PasswordMatchForm;
use Form\PwRecoveryForm;
use Form\StatusForm;
use Form\UserAdressForm;
use Form\UserDataForm;
use Form\UsernameForm;
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
     * USer-Register
   *Nutzer sendet Registrierungsanfrage + keine Formularfehler(Abfrage in Router.php)
    *  Formularfehler abfangen (leeres feld, pw zu kurz/lang, Nutzername bereits Vorhanden)
   *	-gewunschtes pw(verschluesselt) und Username in die DB
   *	-Nutzer vorerst gesperrt(Status=1)
   *	-kein Konfirmationsdatum
   *	-AppMsg = Text, gründe warum Mitglied beitreten will.
   */

    public function registerAction()
    {
        //Model
        $user = new UserMdl();
        if ($this->isPost("u_register")) {
            $form = new UserRegisterForm();
            $errorArray = $form->getErrorList();
            if (!empty($errorArray)) {
                //Formularfehler
                echo $this->render('seitenkomponenten/errors', array("errorArray" => $errorArray));
            }
            //Username bereits Vorhanden?
            //nein:
            //Ab in die DB
            elseif (!$user->isUsername($_POST['username'])) {
                $userData = new \Model\UserMdl();
                $userData->setUsername($_POST['username']);
                $userData->setPwmd5(md5($_POST['password1']));
                $userData->setStatus(1);
                $userData->setAppMsg($_POST['msg']);
                $user->insertUser($userData);
            }
            //Username bereits Vorhanden
            //ja:
            else {
                $errorArray[] = "nameTaken";
                echo $this->render('seitenkomponenten/errors', array("errorArray" => $errorArray));
            }
        }
        $this->getNav();
        echo $this->render('pages/user/userRegistration');
        echo $this->render('seitenkomponenten/footer');
    }


    //einzelnen User bearbeiten

    public function bearbeitenAction()
    {

        //Resource-model
        $resource = new UserMdl();
        //User-Object in Array fuer ausgabe
        $userArray[] = $resource->getUserById($_GET['id']);

        if ($this->isPost('aendern')) {
            //Wert des Formular-Buttons Beispiel: "Dateiname"
            $edit = $_POST['aendern'];
            //USer-Id
            $id = $_GET['id'];
            //Username
            if ($edit == "username") {
                $form = new UsernameForm();
                $errorArray = $form->getErrorList();
                if (count($errorArray) !== 0) {
                    $this->getNav();
                    echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
                    echo $this->render('pages/admin/updateUser', array('userArray' => $userArray));
                } else {
                    $value = $_POST['username'];
                    $resource->UpdateUser($id, 'username', $value);
                    //gutue neuigkeiten
                    $errorArray[] = 'changeSuccess';
                    $this->getNav();
                    echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
                    echo $this->render('pages/admin/updateUser', array('userArray' => $userArray));
                }
            } elseif ($edit == "passwort") {
                $form = new PasswordMatchForm();
                $errorArray = $form->getErrorList();
                if (count($errorArray) !== 0) {
                    $this->getNav();
                    echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
                    echo $this->render('pages/admin/updateUser', array('userArray' => $userArray));
                } else {
                    $value = $_POST['passwortNeu'];
                    $resource->UpdateUser($id, 'pwmd5', md5($value));
                    //gutue neuigkeiten
                    $errorArray[] = 'changeSuccess';
                    $this->getNav();
                    echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
                    echo $this->render('pages/admin/updateUser', array('userArray' => $userArray));
                }
            } elseif ($edit == "status") {
                if (!array_key_exists('status', $_POST)) {
                    $errorArray[] = 'emptyStatus';
                    $this->getNav();
                    echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
                    echo $this->render('pages/admin/updateUser', array('userArray' => $userArray));
                } elseif ($_POST['status'] === '1' || $_POST['status'] === '0') {
                    $value = $_POST['status'];
                    $resource->UpdateUser($id, 'gesperrt', $value);
                    //gutue neuigkeiten
                    $errorArray[] = 'changeSuccess';
                    $this->getNav();
                    echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
                    echo $this->render('pages/admin/updateUser', array('userArray' => $userArray));
                }
            }
        } else {

            $this->getNav();
            echo $this->render('pages/admin/updateUser', array('userArray' => $userArray));
        }


    }


    /*
    *  Buan/user-login
    * user anmeldung
    */
    public function loginAction()
    {        //resource-Model
        $userMdl = new UserMdl();
        if ($this->isPost("userLogin")) {
            //Fehler abfangen.
            $form = new UserLoginForm();
            $errorArray = $form->getErrorList();
            if (!empty($errorArray)) {
                //Formularfehler
                echo $this->render('seitenkomponenten/header');
                echo $this->render('pages/user/UserNav');
                echo $this->render('seitenkomponenten/errors', array("errorArray" => $errorArray));
                echo $this->render('pages/user/user-login');
            } //keine Fehler-> in der DB User authentifizieren
            //funktion gibt model zurueck wenn Userdaten korrekt, sonst false
            //success:
            else {
                if ($userMdl->authenticateUser($_POST['username'], md5($_POST['password']))) {
                    //true wenn: temporaeres passwort richtig und user gesperrt, oder passwort richtig und nicht gesperrt
                    //temporares passwort darf nur einmal genutzt werden: temp_pw leeren
                    //gespeicherte Dateien fuer temporare passwoerter befinden sich im Webroot und
                    // lassen sich identifizieren mit md5(username). Diese datei,wenn vorhanden, loeschen.
                    $user = $userMdl->authenticateUser($_POST['username'], md5($_POST['password']));
                    //temp-passwort datei loeschen:
                    if(file_exists(md5($user->getUsername()))){unlink(md5($user->getUsername()));}

                    $userMdl->unlockUser($user->getId());

                    $_SESSION['user'] = "loggedIn";
                    $_SESSION['username'] = $user->getUsername();
                    $_SESSION['userId'] = $user->getId();
                    //alles in Ordnung: weiter zum Dashboard
                    header('Location: user-home');
                } //anmeldung hat nicht geklappt::fehler ausgeben.
                else{
                    //anzeigeFehler
                    $errorArray[] = 'nameNot';
                    echo $this->render('seitenkomponenten/header');
                    echo $this->render('pages/user/UserNav');
                    echo $this->render('seitenkomponenten/errors', array("errorArray" => $errorArray));
                    echo $this->render('pages/user/user-login');
                }
            }
        }
        //post ist nicht gesetzt:
        else
        {
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
                /*
                 *
                 * Normalerweise:
                // Email generieren und- versenden
                //$this->sendRecovery($mail,$recPass,$_POST['username']);
                *
                 *
                 */
                 $recoveryArray['username']=$_POST['username'];
                 //dummy Mail:
                //$this->generateRecoveryMail($recPass,$_POST['username'])
                //pdf generation:
                //Link fuer temp. Passwort (oeffnet in neuem Tab):
                $this->generateRecoveryPdf($recPass,$_POST['username']);
                $this->getNav();
                echo $this->render('pages/user/pw_recovery', array("recoveryArray" => $recoveryArray));
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

    //PAsswort-recovery email-Dummy
    public function generateRecoveryMail($pass,$username)
    {
        //https://www.php-einfach.de/php-tutorial/php-email/
        $empfaenger_email = "max.musterman@mail.de";
        $from = "From: Vorname Nachname <sender@domain.de>\r\n";
        $from .= "Content-Type: text/html\r\n";
        $betreff = 'Recovery Password';
        $nachricht = 'hi'.$username."\n Recovery Password:".$pass;
        mail($empfaenger_email, $betreff, $nachricht, $from);
    }

    //Pdf generieren fuer vorruebergehnde Passwortdaten
    public function generateRecoveryPdf($pass,$username)
    {
        require_once './fpdf/fpdf.php';
        $pdf = new \FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,'Hallo,'.$username);
        $pdf->Cell(10,20,'');
        $pdf->Cell(40,30,'dein passwort:    '.$pass);
        $pdf->Output('F',md5($username),true);

    }

    //pdf datei anzeigen
    public function recoverydataAction()
    {
        $hash = $_GET['hash'];
        header("content-type: application/pdf");
        echo file_get_contents($hash);
    }


    //randomisiertes Passwort erzeugen fuer den Passwort vergessen-Vorgang
    public function generateRecoveryPassword():string
    {
        //erwuenschte Zeichen
        $characters = 'ABCDEFGHIJKLMNOPQRSTUWXYZabcdefghijklmnopqrstuvwxyz123456789';
        /*substr: Gibt einen Teil eines Strings zurück, str_shuffle: mischt Zeichen im String nach dem Zufallsprinzip*/
        return $recPass = substr(str_shuffle($characters), 0, 7);
    }


    public function setNewPassword()
    {
        //ResourceModel
        $user = new UserMdl();
        $userArray[] = $user->getUserById($_SESSION['userId']);

        //post verarbeiten
        if ($this->isPost('password')) {

            //Fehler abfangen
            $form = new PasswordMatchForm();
            $errorArray = $form->getErrorList();
            if (!empty($errorArray)) {
                $this->getNav();
                //Formularfehler
                echo $this->render('seitenkomponenten/errors', array("errorArray" => $errorArray));
                echo $this->render('pages/user/setUserPassword', array('userArray' => $userArray));
            }
            else {
                //alles ok, ab in die db
                $user->updatePasswort($_POST['passwortNeu'], $_SESSION['userId']);
                //Formular zuruecksetzen
                unset($_POST['password']);
                //header("refresh: 2");
                //gute nachrichten
                $errorArray[] = 'changeSuccess';
                //anzeige
                $this->getNav();
                echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
                echo $this->render('pages/user/setUserPassword', array('userArray' => $userArray));
            }

        } else {
            $this->getNav();
            echo $this->render('pages/user/setUserPassword', array('userArray' => $userArray));
        }
    }
    public function updatePassword()
    {
        //ResourceModel
        $user = new UserMdl();
        $userArray[] = $user->getUserById($_SESSION['userId']);

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
            }
            //stimmt dieses Passwort?
            elseif (!$user->isPassword($_POST['passwortAlt'], $_SESSION['userId'])) {
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

    //passwort aendern oder neu setzten wenn user in einer Passwort-recovery Situation ist
    public function passwortAction()
    {
        /*
          * Besitzt dieser user ein PAsswort? wenn nein, dann wurde ein temporaeres Passwort
          * angefordert und User muss ein neues Pw setzen:
          *
          */
        $userMdl = new UserMdl();
       if($userMdl->isUserRecovery($_SESSION['userId']))
       {
           $this->setNewPassword();
       }else
       {
           $this->UpdatePassword();
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
        //ResourceModel
        $resource = new UserMdl();
        if ($this->isPost('auth') && isset($_POST['status']))
        {
            //UserSperrstatus aufheben:
            $resource->authUser($_POST['id'], $_POST['status']);
        }
        //gesperrte User anzeigen:
        $this->getNav();
        $userArray = $resource->getUnauthUsers();
        //keine gesperrten User: meldung, sonst Anzeige
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
        //Anzeige
        $this->getNav();
        $resource = new UserMdl();
        $userArray = $resource->getAllAuthUsers();
        echo $this->render('pages/admin/editUsers', array('userArray' => $userArray));
    }


    /*USer Homeansicht:
    / Produkte uebersicht, shopping moeglichkeit.
    -wenn user eingeloggt:
    -User Navigationsleiste (abmelden, passwort Aendern etc.)
    -Artikel in den Warenkorb legen
    */
    public function homeAction()
    {    $this->getNav();
        if ($this->isPost('toCart')) {
            $cart = new CheckoutCtrl();
            //Wenn warenkorb leer:insert, sonst:update
            $cart->addToCart();
        }
        $produkte = new \Controller\ProduktCtrl();
        echo $this->render('pages/home', $produkte->showProducts());
        echo $this->render('seitenkomponenten/footer');

    }


    //eigenen Username aendern
    public function datenAction()
    {
        //ResourceModel
        $user = new UserMdl();
        $userArray[] = $user->getUserById($_SESSION['userId']);
        //Post verarbeiten
        if ($this->isPost('userName')) {
            //FehlerMeldungen in Array
            $form = new UserDataForm();
            $errorArray = $form->getErrorList();
            //Formularfehler ja: Anzeige (input leer etc.)
            if (!empty($errorArray)) {
                //Anzeige
                $this->getNav();
                echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
                echo $this->render('pages/user/updateUserData', array('userArray' => $userArray));
            } //Formularfehler neine aber USername bereits vergeben?
            elseif ($user->isNewUsername($_POST['username'], $_SESSION['userId'])) {
                $errorArray[] = 'nameTaken';
                $this->getNav();
                echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
                echo $this->render('pages/user/updateUserData', array('userArray' => $userArray));
            } else {
                //keine Fehler -> update in Db
                $user->updateUsername($_POST['username'], $_SESSION['userId']);
                //formular zuruecksetzen
                unset($_POST['userName']);
                //seite aktualisieren
                header("refresh:2");
                //gute nachrichten anzeigen
                $errorArray[] = 'changeSuccess';
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


    //eigene useradressdaten anpassen
    // wenn bereits eine Adresse eingegeben wurde, dann update on Post, sonst Insert on Post
    //template: pages/user/updateUserAdress;
    public function adresseAction()
    {
        //Formularfehler
        $form = new UserAdressForm();
        $errorArray = $form->getErrorList();
        //ResourceModel
        $address = new AdressMdl();
        //Adresse gibt es schon?
        //dann update bei POST
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
        //dann Insert bei POST
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



    //Bestellungen einsehen Ansicht
    //template: "pages/bestellungen/user-bestellungen" fuer Auwahl zeitraum
    // template: "pages/bestellungen/user-bestellungen-anzeigen" fuer Anzeige Bestellungen in diesem Zeitraum
    public function bestellungenAction()
    {
        $this->getNav();
        //resourceModel
        $resource = new BestellungenMdl();
        // gibt es zu diesem User bereits bestellungen?
        if ($resource->isOrders()) {
            // array mit validen betselljahren und monaten fuer auswahlfeld auf clientseite
            $orderArray = $resource->getUserOrderDates();
            echo $this->render('pages/bestellungen/user-bestellungen', array('orderArray' => $orderArray));
            //User waehlt Zeitraum ueber select/option feld aus
            if ($this->isPost('seeOrders')) {
                //Post gibt Datum und Monat im Format '0000-00' zurueck.
                // formatieren:
                $datum = explode('-', $_POST['jahrMonat']);
                 $jahr = $datum[0];
                 $monat = $datum[1];
                //Bestellungen aus diesem Zeitraum:
                $orderArray = $resource->getBestellungen($monat, $jahr);
                echo $this->render('pages/bestellungen/user-bestellungen-anzeigen', array('orderArray' => $orderArray));
            }
        } else {
            //noch nichts bestellt?
            $errorArray = array();
            $errorArray[] = 'noOrders';
            echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
        }
    }

    //einzelne Rechnung PDF
    public function invoiceAction()
    {
        $bestellung = new BestellungenMdl();
        $order=$bestellung->getBestellungById($_GET['id']);
        require_once('./fpdf/fpdf.php');
        $pdf = new \FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','i',12);
        $height =10;
        foreach($order as $order )
        {

            $pdf->SetXY(10,$height);
            $pdf->Cell(40,40,$order->getPNameD());
            $height+=10;
        }

        $pdf->Output();
    }

}