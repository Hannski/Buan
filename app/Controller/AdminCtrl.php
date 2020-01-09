<?php
/*
 * Wilkommen im Admin-Controller. Hier werden alle Anfragen bezueglich des Admins verarbeitet.
 * Anhand der url, lassen sich die verschiedenen Methoden dieses Controllers aufrufen.
 * Jede Funktion in diesem Controller startet daher mit einer Abfrage, ob der Zugriff genehmigt- oder umgeleitet wird
 * auf eine "kein Zugriff"- Seite.
 * */

namespace Controller;
use Form\addAdminForm;
use Form\AdminCredentialsForm;
use Form\UserNewPasswordForm;
use \Model\Resource\AdminMdl;
use Form\AdminLoginForm;
use Model\Resource\BestellungenMdl;



class AdminCtrl extends AbstractCtrl
{
    //Ueberblick ueber alle Betsellungen in diesem Monat, geordnet nach Datum
    public function monthlyOrdersAction()
    {
    //nur administratoren duerfen hier her
        $this->allAdminsOnly();

        //monate und Jahre mit Bestellungen aus der Datenbank holen.
        $resource  = new BestellungenMdl();
        //Array
        $bestelldaten= $resource->getOrderdates();

        //Post verarbeiten
        //betstellung soll gesperrt werden:
        if($this->isPost('dropOrder'))
        {
            //Bestellung sperren
            $resource->lockOrder($_POST['order_id']);
            //nachricht an den Nutzer
            $errorArray[] = 'changeSuccess';
            $this->getNav();
            echo $this->renderErrors($errorArray);
            echo $this->render('pages/admin/pickOrderMonth',array('bestelldaten'=>$bestelldaten));
            $this->getFooter();
        }
        //Bestellung Entsperren
        elseif($this->isPost('unlockOrder'))
        {
            //Bestellung entsperren
            $resource->unlockOrder($_POST['order_id']);
            $errorArray[] = 'changeSuccess';
            $this->getNav();
            echo $this->renderErrors($errorArray);
            echo $this->render('pages/admin/pickOrderMonth',array('bestelldaten'=>$bestelldaten));
            $this->getFooter();
        }
        elseif($this->isPost('seeOrders'))
        {

            //POSt gibt gewunschtes Dtaum im format jahr-monat zurueck-> explode
            $datechunks = explode('-',$_POST['jahrMonat']);

            $jahr = $datechunks[0];
            $monat = $datechunks[1];

            //zugehoerige Bestellungen aus der Datenbank holen und anzeigen
            $orderArray = $resource->getOrders($monat,$jahr);

            $this->getNav();
            echo $this->render('pages/admin/pickOrderMonth',array('bestelldaten'=>$bestelldaten));
            echo $this->render('pages/admin/listOrders',array('orderArray'=>$orderArray));
            $this->getFooter();

        }
        //Post nicht egsetzt, nur anzeige
        else
            { $this->getNav();
            echo $this->render('pages/admin/pickOrderMonth',array('bestelldaten'=>$bestelldaten));
            $this->getFooter();
            }
    }

    //Formular um Daten eines Admins zu aendern (vorname, nachname, Passwort).
    //Diese Funktion ist dem Superadmin vorbehalten.
    //Template: 'pages/admin/UpdateAdmin'
    public function verwaltenAction()
    {
        $this->superOnly();
        if ($this->isPost('aendern')) {
            //Fehlerarray
            $errorArray = array();
            //universalabfrage gilt in diesem Fall für alle Felder:
            if (!empty($_POST['edit']) && $_POST['aendern'] !== 'gesperrt') {
                $resource = new AdminMdl();
                //spalte die in der DB angepasst werden soll:
                $row = $_POST['aendern'];
                //neuer Wert
                $edit = $_POST['edit'];
                //id
                $id = $_GET['id'];

                //Gibt es diesen Admin schon?
                if ($row == 'a_vorname') {
                    //noch aktueller Nach -oder Vorname
                    $curName = $_POST['curName'];
                    //neuer Vorname + aktueller nachname bereits in Db
                    if ($resource->verifyNewFirst($edit, $curName)) {
                        //fehler
                        $errorArray[] = 'nameTaken';
                        $this->renderErrors($errorArray);
                    } else {
                        //Update
                        $resource->updateAdmin($id, $row, $edit);
                        header('refresh:0');
                    }
                } elseif ($row == 'a_nname') {
                    $curName = $_POST['curName'];
                    //neuer Nachname + aktueller Vorname bereits in Db
                    if ($resource->verifyNewLast($edit, $curName)) {
                        //Fehler
                        $errorArray[] = 'nameTaken';
                        $this->renderErrors($errorArray);
                    } else {
                        //keine Probleme: Update in Db
                        $resource->updateAdmin($id, $row, $edit);
                        header('refresh:0');
                    }
                } elseif ($row == 'a_pwmd5') {
                    //pw-hashen
                    $resource->updateAdmin($_GET['id'], $row, md5($edit));
                    header('refresh:0');
                }

            } elseif ($_POST['aendern'] == 'gesperrt') {
                //Status
                $resource = new AdminMdl();
                $resource->updateAdmin($_GET['id'], $_POST['aendern'], $_POST['edit']);
                header('refresh:0');

            } //inputfeld ist leer:
            //Fehlerausgabe:
            else {
                $errorArray[] = 'emptyField';
                $this->renderErrors($errorArray);
            }
        }
        //Anzeige
        $this->getNav();
        $resource = new AdminMdl();
        $adminArray[] = $resource->getAdminById($_GET['id']);
        echo $this->render('pages/admin/UpdateAdmin', array('adminArray' => $adminArray));
    }


    //Admins verwalten Ansicht: Uebersicht ueber alle Administratoren
    //Template: 'pages/admin/listAdmins'
    public function verwaltungAction()
    {
        //nur superadmin
        $this->superOnly();
        $adminArray = new AdminMdl();
        $adminArray = $adminArray->getAllAdmins();
        //Anzeige
        echo $this->getNav();
        echo $this->render('pages/admin/listAdmins', array('adminArray' => $adminArray));
    }

    //Admin-Logout
    //AdminSessionvariabeln leeren, Weiterleitung
    //Template: 'pages/alerts/logout'
    public function logoutAction()
    {
        $this->allAdminsOnly();
        //weiterleitung nach 3 Sekunden auf Startseite:
        header("refresh:3;./");
        $this->getNav();
        //nachricht an User:
        echo $this->render('pages/alerts/logout');
        //Sessionvariablen leeren:
        unset($_SESSION['admin']);
        unset($_SESSION['adminName']);
        unset($_SESSION['super']);
        unset($_SESSION['superName']);
        unset($_SESSION['adminId']);
    }




    //Admin erstellen. Diese Funktion ist dem Superadmin vorbehalten.
    //Template: 'pages/admin/AddAdmins'
    public function erstellenAction()
    {
        //nur superadmin
        $this->superOnly();
        //Resource-Model
        $admin = new AdminMdl();
        //Formularfehler abfangen
        if ($this->isPost('addAdmin')) {
            //neues Fehlerformular
            $form = new addAdminForm();
            // Fehlerarray
            $errorArray = $form->getErrorList();
            //nicht leer: Fehler ausgeben
            if (!empty($errorArray)) {
                echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
            } //Fehlerarray leer. Gibt es den Admin schon?
            elseif ($admin->adminExists($_POST['vorname'], $_POST['nachname'])) {
                //Diesen Admin gibt es schon. Keine doppelten Eintraege in der Datenbank erlaubt.
                $errorArray[] = "nameTaken";
                echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
            } else {
                //Kein Problem: ab in die Datenbank;
                $admin->insertAdmin($_POST['nachname'], $_POST['vorname'], $_POST['password1']);
            }
        }
        //Anzeige
        $this->getNav();
        echo $this->render('pages/admin/AddAdmins');
        echo $this->render('seitenkomponenten/footer');
    }


    //AdminDashboard Ansicht
    public function homeAction()
    {
        //nur Administratoren
        $this->allAdminsOnly();
        //Navigation wird im Navigationstemplate logisch ausgewertet nach Rolle des Benutzers.
        $this->getNav();
        $this->getFooter('super','loggedIn');
    }

    //Admin-Login
    // Template: "pages/admin/adminlogin"
    public function loginAction()
    {
        //wenn schon eingeloggt, weiterleitung.
        if($this->isAdmin()){ header("Location: admin-home");}
        if($this->isSuperAdmin()){ header("Location: admin-home");}

        //Resourcemodel
        $admin = new AdminMdl();
        //Formular auswerten
        if ($this->isPost("a_login")) {
            //neues Fehlerformular
            $form = new AdminLoginForm();
            //Fehlerarray
            $errorArray = $form->getErrorList();
            //Array nicht leer: Fehler ausgeben
            if (!empty($errorArray)) {
                //Formularfehler
                $this->getNav();
                echo $this->render('seitenkomponenten/errors', array("errorArray" => $errorArray));
                echo $this->render("pages/admin/adminlogin");
                $this->getFooter('super','loggedIn');
            }
            //Array leer: gibt es diesen Admin mit diesem Passwort? ja:
            //autheticate gibt bei erfolg adminmodel zureck, sonst false
            elseIf ($admin->authenticateAdmin($_POST['vorname'], $_POST['nachname'], md5($_POST['password']))) {
                $admin = $admin->authenticateAdmin($_POST['vorname'], $_POST['nachname'], md5($_POST['password']));
                //User authentifiziert aber gesperrt?
                if ($admin->getStatus() == 1) {
                    ///Anzeige Fehler
                    $errorArray[] = 'locked';
                    $this->getNav();
                    echo $this->render('seitenkomponenten/errors', array("errorArray" => $errorArray));
                    echo $this->render("pages/admin/adminlogin");
                    $this->getFooter('super','loggedIn');
                } else {
                    //adminModel wurde zurueckgegeben. Admin authentifiziert und nicht gesperrt.
                    //Wer bst du? SuperAdmin oder normaler Admin?
                    $adminStatus = $admin->getSuper();
                    //Session variablen setzen fuer Superadmin: status, name, id
                    if ($adminStatus == 1) {
                        $_SESSION['super'] = "loggedIn";
                        $_SESSION['adminId'] = $admin->getAId();
                        $_SESSION['superName'] = $admin->getAVorname() . "&nbsp;" . $admin->getANname();
                        //header-Ausgabe
                        header('Location: admin-home');
                    } else {
                        //Session variablen setzen fuer Admin: status, name, id
                        $_SESSION['admin'] = "loggedIn";
                        $_SESSION['adminId'] = $admin->getAId();
                        $_SESSION['adminName'] = $admin->getAVorname() . "&nbsp;" . $admin->getANname();
                        //header ausgabe
                        header('Location: admin-home');
                    }
                }
            } else {
                //Authetifizierung Fehlgeschlagen, pw oder username stimmen nicht :
                $errorArray[] = 'nameNot';
                $this->getNav();
                echo $this->render('seitenkomponenten/errors', array("errorArray" => $errorArray));
                echo $this->render("pages/admin/adminlogin");
                $this->getFooter('super','loggedIn');
            }

        } else {
            //kein Post gesetzt: Anzeige
            $this->getNav();
            echo $this->render("pages/admin/adminlogin");
            $this->getFooter('super','loggedIn');
        }
    }

    //Admin-eigenen Vor- und Nachnamen aendern:
    //Template: 'pages/admin/updateAdminUsernames'
    public function credentialsAction()
    {
        //nur fuer administartoren
        $this->allAdminsOnly();
        //Fehlerarray
        $errorArray = array();
        //resourceModel:
        $adminMdl = new AdminMdl();
        $admin = $adminMdl->getAdminById($_SESSION['adminId']);
        $adminArray = ['admin' => $admin];
        //Post auswerten:
        if ($this->isPost('updateCredentials')) {
            //neues Fehlerformular
            $form = new AdminCredentialsForm();
            $errorList = $form->getErrorList();
            //Fehlerarray nicht leer?
            if (count($errorList) !== 0) {   //Fehler ausgeben
                $errorArray = $errorList;
                $this->getNav();
                echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
                echo $this->render('pages/admin/updateAdminUsernames', $adminArray);
            } //keine Formularfehler. Gibt es diesen vor+zunamen schon? Ja:
            elseif ($adminMdl->adminExists($_POST['vorname'], $_POST['nachname'])) {   //Fehler ausgeben
                $errorArray[] = 'nameTaken';
                $this->getNav();
                echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
                echo $this->render('pages/admin/updateAdminUsernames', $adminArray);
            } //keine Probleme: ab in die Datenbank.
            else {
                $adminMdl->updateAdmin($_SESSION['adminId'], 'a_vorname', $_POST['vorname']);
                $adminMdl->updateAdmin($_SESSION['adminId'], 'a_nname', $_POST['nachname']);
                $errorArray[] = 'changeSuccess';
                $this->getNav();
                $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
                echo $this->render('pages/admin/updateAdminUsernames', $adminArray);

            }

        } else {
            //Post ist nicht gesetzt: Anzeige
            $this->getNav();
            echo $this->render('pages/admin/updateAdminUsernames', $adminArray);
        }

    }


    //Admin- eigenes passwort aendern:
    //Template: pages/admin/updateAdminPassword
    public function passwordAction()
    {
        $this->allAdminsOnly();
        //resource Model
        $admin = new AdminMdl();
        //Array mit AdminDaten
        $adminArray[] = $admin->getAdminById($_SESSION['adminId']);
        //Formular auswerten
        if ($this->isPost('password')) {
            //neues Fehlerformular (Postwerte gleich wie bei Usern)
            $form = new UserNewPasswordForm();
            $errorArray = $form->getErrorList();
            //Fehlerarray nicht leer
            if (!empty($errorArray)) {
                //Fehler anzeigen
                $this->getNav();
                echo $this->renderErrors($errorArray);
                echo $this->render('pages/admin/updateAdminPassword', array('adminArray' => $adminArray));
            } else {
                //keine Formularfehler, stimmt das alte Passwort:
                if (!$admin->isPassword($_POST['passwortAlt'], $_SESSION['adminId'])) {
                    //Passwort stimmt nicht: Fehler ausgeben
                    $errorArray[] = 'pwNope';
                    $this->getNav();
                    echo $this->renderErrors($errorArray);
                    echo $this->render('pages/admin/updateAdminPassword', array('adminArray' => $adminArray));

                } else {
                    //keine Probleme: Client benachrichtigen und neues Passwort ab in die Datenbank.
                    $admin->updateAdmin($_SESSION['adminId'], 'a_pwmd5', md5($_POST['passwortNeu']));
                    $errorArray[] = 'changeSuccess';
                    $this->getNav();
                    echo $this->renderErrors($errorArray);
                    echo $this->render('pages/admin/updateAdminPassword', array('adminArray' => $adminArray));
                }
            }
        } else {
            //anzeige wenn kein Post:
            $this->getNav();
            echo $this->render('pages/admin/updateAdminPassword', array('adminArray' => $adminArray));
        }

    }

}

