<?php

namespace Controller;

use Form\addAdminForm;
use Form\AdminCredentialsForm;
use Form\UserNewPasswordForm;
use \Model\Resource\AdminMdl;
use Form\AdminLoginForm;
use Form\AdminUpdateAdminData;
use Model\Resource\UserMdl;


class AdminCtrl extends AbstractController
{

    //Daten eines einzelnen Amdinistrators bearbeiten
    public function verwaltenAction()
    {
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
                    $resource->updateAdmin($id, $row, md5($edit));
                    header('refresh:0');
                }

            } elseif ($_POST['aendern'] == 'gesperrt') {
                //Status
                echo $_POST['edit'];
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


    //Admins verwalten: Liste aller Administratoren
    public function verwaltungAction()
    {
        $adminArray = new AdminMdl();
        $adminArray = $adminArray->getAllAdmins();
        //Anzeige
        echo $this->getNav();
        echo $this->render('pages/admin/listAdmins', array('adminArray' => $adminArray));
    }

    //Admin-Logout
    //AdminSessionvariabeln leeren, weiterleitung
    public function logoutAction()
    {
        //weiterleitung nach 5 Sekunden auf Startseite:
        header("refresh:3;./");
        $this->getNav();
        //nachricht an User:
        echo $this->render('pages/alerts/logout');
        if (isset($_SESSION['admin'])) {
            $_SESSION['admin'] = '';
            $_SESSION['adminName'] = "";
        } else {
            $_SESSION['super'] = '';
            $_SESSION['superName'] = "";
        }
    }


    //Admin erstellen
    public function erstellenAction()
    {
        $admin = new AdminMdl();
        $this->getNav();
        if ($this->isPost('addAdmin')) {
            //Formularfehler abfangen
            $form = new addAdminForm();
            $errorArray = $form->getErrorList();
            if (!empty($errorArray)) {
                echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
            } //gibt es den Admin schon?
            elseif ($admin->adminExists($_POST['vorname'], $_POST['nachname'])) {
                $errorArray[] = "nameTaken";
                echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
            } else {
                //ab in die Datenbank;
                $admin->insertAdmin($_POST['nachname'], $_POST['vorname'], $_POST['password1']);
            }
        }
        echo $this->render('pages/admin/AddAdmins');
        echo $this->render('seitenkomponenten/footer');
    }


    //Dashboard
    public function homeAction()
    {
        //Navigation je nach AdminTyp
        $this->getNav();
        echo $this->render("seitenkomponenten/footer");
    }

    //Admin-Login
    public function loginAction()
    {
        $admin = new AdminMdl();
        if ($this->isPost("a_login")) {
            $form = new AdminLoginForm();
            $errorArray = $form->getErrorList();
            if (!empty($errorArray)) {
                //Formularfehler
                $this->getNav();
                echo $this->render('seitenkomponenten/errors', array("errorArray" => $errorArray));
                echo $this->render("pages/admin/adminlogin");
            } //gibt es diesen admin mit diesem Passwort? ja:
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
                } else {
                    //adminModel
                    //superAdmin oder normaler Admin?
                    $adminStatus = $admin->getSuper();
                    //Session variableln setzten: status, name
                    if ($adminStatus == 1) {
                        $_SESSION['super'] = "loggedIn";
                        $_SESSION['adminId'] = $admin->getAId();
                        $_SESSION['superName'] = $admin->getAVorname() . "&nbsp;" . $admin->getANname();
                        //header-Ausgabe
                        header('Location: admin-home');
                    } else {
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
            }

        } else {
            //kein Post:
            $this->getNav();
            echo $this->render("pages/admin/adminlogin");
        }
    }

    //admin- eigenen vor-und nachnamen aendern
    //template:
    public function credentialsAction()
    {
        //Fehlerarray
        $errorArray = array();
        //resourceModel:
        $adminMdl = new AdminMdl();
        $admin = $adminMdl->getAdminById($_SESSION['adminId']);
        $adminArray=['admin'=>$admin];

       if   ($this->isPost('updateCredentials'))
       {
           //Formularfehler abfangen
           $form = new AdminCredentialsForm();
           $errorList = $form->getErrorList();
           //Fehler ausgeben
          if (count($errorList) !==0)
          {
              $errorArray = $errorList;
              $this->getNav();
              echo $this->render('seitenkomponenten/errors',array('errorArray'=>$errorArray));
              echo $this->render('pages/admin/updateAdminUsernames',$adminArray);
          }
          //keine Formularfehler. Gibt es diesen vor+zunamen schon?
          elseif($adminMdl->adminExists($_POST['vorname'],$_POST['nachname']))
          {
              $errorArray[]= 'nameTaken';
              $this->getNav();
              echo $this->render('seitenkomponenten/errors',array('errorArray'=>$errorArray));
              echo $this->render('pages/admin/updateAdminUsernames',$adminArray);
          }
          //keine Probleme: ab in die Db.
          else{
              $adminMdl->updateAdmin($_SESSION['adminId'],'a_vorname',$_POST['vorname']);
              $adminMdl->updateAdmin($_SESSION['adminId'],'a_nname',$_POST['nachname']);
              $errorArray[] = 'changeSuccess';
              $this->getNav();
              $this->render('seitenkomponenten/errors',array('errorArray'=>$errorArray));
              echo $this->render('pages/admin/updateAdminUsernames',$adminArray);

          }

       }else{
           $this->getNav();
           echo $this->render('pages/admin/updateAdminUsernames',$adminArray);
       }

    }


    //Admin- eigenes passwort aendern:
    //template: pages/admin/updtaeAdminPassword
    public function passwordAction()
    {
        //resource Model
        $admin = new AdminMdl();
        //Array mit AdminDaten
        $adminArray[] = $admin->getAdminById($_SESSION['adminId']);
        $adminObject = $admin->getAdminById($_SESSION['adminId']);

        if ($this->isPost('password')) {
            //Formularfehlerarray, Formularauswertung bezieht sich auf gleiche werte wie ebi user-passwort-update
            $form = new UserNewPasswordForm();
            $errorArray = $form->getErrorList();
            if (!empty($errorArray)) {
                $this->getNav();
                echo $this->renderErrors($errorArray);
                echo $this->render('pages/admin/updateAdminPassword', array('adminArray' => $adminArray));
            } else {
                //keine Formularfehler, stimmt das alte Passwort:
                if (!$admin->isPassword($_POST['passwortNeu'], $_SESSION['adminId'])) {
                    //Passwort stimmt nicht
                    $errorArray[] = 'pwNope';
                    $this->getNav();
                    echo $this->renderErrors($errorArray);
                    echo $this->render('pages/admin/updateAdminPassword', array('adminArray' => $adminArray));

                } else {
                    $admin->updateAdmin( $_SESSION['adminId'],'a_pwmd5',md5($_POST['passwortNeu']));
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

 