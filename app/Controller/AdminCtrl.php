<?php
namespace Controller;
use Form\addAdminForm;
use \Model\Resource\AdminMdl;
use Form\AdminLoginForm;
use Form\AdminUpdateAdminData;


class AdminCtrl extends AbstractController
{

    //Fehler rendern wenn Fehler vorhanden
    public function renderErrors($errorArray)
    {
        if(empty($errorArray)){return false;}else {
            echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
        }
    }
//einzelnen Amdinistrator bearbeiten
public function verwaltenAction()
{
    if ($this->isPost('aendern')) {
        //Fehlerarray
        $errorArray = array();
        //universalabfrage gilt in diesem Fall für alle Felder:
        if(!empty($_POST['edit'])&& $_POST['aendern']!=='gesperrt') {
            $resource = new AdminMdl();
            //spalte die in der DB angepasst werden soll:
            $row = $_POST['aendern'];
            //neuer Wert
            $edit = $_POST['edit'];
            //id
            $id = $_GET['id'];

            //Abfangen: Admin gibt es bereits:
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
                    //Update
                    $resource->updateAdmin($id, $row, $edit);
                    header('refresh:0');
                }
            }
            elseif($row == 'a_pwmd5')
            {
                //pw-hashen
                $resource->updateAdmin($id, $row, md5($edit));
                header('refresh:0');
            }

        }elseif($_POST['aendern'] == 'gesperrt')
        {

          $resource = new AdminMdl();
          $resource->updateAdmin($_GET['id'], $_POST['aendern'], $_POST['edit']);

        }
        //inputfeld ist leer:
            else{
                $errorArray[] = 'emptyFields';
                $this->renderErrors($errorArray);

        }


    }

    //Anzeige
    echo $this->getNav();
    $resource = new AdminMdl();
    $adminArray = $resource->getAdminById($_GET['id']);
    echo $this->render('pages/admin/UpdateAdmin',array('adminArray'=>$adminArray));

}



    //Admins verwalten: Liste aller Administratoren
public function verwaltungAction()
{
echo $this->getNav();
$adminArray = new AdminMdl();
$adminArray = $adminArray->getAllAdmins();


echo $this->render('pages/admin/listAdmins',array('adminArray'=>$adminArray));
}

//Admin-Logout
public function logoutAction()
{
    //weiterleitung nach 5 Sekunden auf Startseite:
    header( "refresh:5;./" );
    $this->getNav();
    //nachricht an User:
    echo $this->render('pages/alerts/logout');
    if(isset($_SESSION['admin'])){
        $_SESSION['admin']='';
    $_SESSION['adminName']="";}
    else{$_SESSION['super']='';
    $_SESSION['superName']="";}

}



    //Superadmin-> Admin erstellen
    public function erstellenAction()
    {
        //Navigation je nach AdminTyp
        $this->getNav();
        if ($this->isPost('addAdmin'))
        {
            //Formularfehler abfangen
            $form = new addAdminForm();
            $errorArray=$form->getErrorList();
            if(!empty($errorArray))
            {
                echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
            }
            //gibt es den Admin schon?
            elseif($this->adminExists())
            {
                $errorArray[] = "nameTaken";
                echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
            }
            else{
                //ab in die Datenbank;
                $this->addAdmin();
            }
        }
        echo $this->render('pages/admin/AddAdmins');
        echo $this->render('seitenkomponenten/footer');
    }

    //gibt es einen diesen Admin schon?
    public function adminExists()
    {
        return AdminMdl::adminExists($_POST['vorname'],$_POST['nachname']);
    }
    //Dashboard
    public function homeAction()
    {
        //Navigation je nach AdminTyp
        $this->getNav();
        echo $this->render("seitenkomponenten/footer");
    }

    //Login
    public function loginAction()
    {
        if($this->isPost("a_login"))
        {
            $form = new AdminLoginForm();
            $errorArray = $form->getErrorList();
            if(!empty($errorArray)){
                //Formularfehler
                $this->getNav();
                echo $this->render('seitenkomponenten/errors', array("errorArray" => $errorArray));
                echo $this->render("pages/admin/adminlogin");
            }
            //keine Fehler-> in der DB  authentifizieren
            elseIf($this->authenticateAdmin()){
                //gibt AdminInstanz zurueck
                $admin = $this->authenticateAdmin();
                //User authentifiziert aber gesperrt?
                if($admin->getStatus())
                {
                    ///Anzeige Fehler
                    $errorArray[] = 'gesperrt';
                    $this->getNav();
                    echo $this->render('seitenkomponenten/errors', array("errorArray" => $errorArray));
                    echo $this->render("pages/admin/adminlogin");
                }else
                {
                    $admin = $this->authenticateAdmin();
                    $adminStatus = $admin->getSuper();
                    if ($adminStatus == 1)
                    {
                        $_SESSION['super'] ="loggedIn";
                        $_SESSION['superName'] =$admin->getAVorname()."&nbsp;".$admin->getANname();
                        //header-Ausgabe
                        header('Location: admin-home');
                    }else
                    {
                        $_SESSION['admin'] ="loggedIn";
                        $_SESSION['adminName'] =$admin->getAVorname()."&nbsp;".$admin->getANname();
                        //header ausgabe
                        header('Location: admin-home');
                    }
                }
            }
            else{
                //Authetifizierung Fehlgeschlagen, pw oder username nicht gefunden:
                $errorArray[] = 'nameNot';
                $this->getNav();
                echo $this->render('seitenkomponenten/errors', array("errorArray" => $errorArray));
                echo $this->render("pages/admin/adminlogin");
            }

        }else{
            $this->getNav();
            echo $this->render("pages/admin/adminlogin");
        }



    }

    //Gibt es den admin in der db->dann gib Model zurück sonst false.
	public function authenticateAdmin()
    {
        $model=new AdminMdl();
        return $model->authenticateAdmin($_POST['name'],$_POST['nachname'],md5($_POST['password']));
    }

  /*Login-Formular Auswertung*/
    public function adminLoginForm()
    {
    
    $vname = $_POST['name'];
    $nname = $_POST['nachname'];
    //md5 verschluesselung fuer Abgleich, Passwort ist verschluesselt in DB hinterlegt.
    $pw = md5($_POST['password']);
   
    if(empty($vname) || empty($nname) || empty($pw))
      {
      //Alle Felder leer: bitte alle felder ausfuellen
      $_SESSION["errors"] ="emptyFields";
      }else{
         //authorizeAdmin gibt AdminModel(wenn Eintrag gefunden) mit daten des passenden Datensatzes in DB zurueck
          if(AdminMdl::authorizeAdmin($vname,$nname,$pw))
          {
            $admin = AdminMdl::authorizeAdmin($vname,$nname,$pw);
            /*Wenn Status = 1, dann ist der Administrator gesperrt worden
            * -Nachricht ueber Sperrung an Nutzer
            */
              if($admin->getStatus()==1)
              {
                $_SESSION["errors"]="locked";
              }
              elseif($admin->getSuper()==1)
              {
                /* Wenn Asmin=SuperAdmin, Sesison setzen, da Superadmin erweiterte AdminRechte besitzt
                *   -superAdminSession speichern.
                *   -freigabe zur weiterleitung nach Admin-Dashboard
                */
                $_SESSION['super']="super";
                return true;
              }
              else
              {
                //Freigabe zur Weiterleitung zu Amdindashboard.
                return true;
              }
           }
            else
            {//Fehler im Code: "OOPS!-Meldung"
              $_SESSION["errors"] = "nope";
            }
        }
      }
  




   //Im Admin Dashboard Optionen zur Bearbeitung, erstellung und Sperrung von Produkten und Nutzern
   public function adminOption($dashboardview)
   {
    if( $dashboardview == "change_p" || "change_u" ||  "add_p")
    {
      return "/pages/".$dashboardview.".php";
    }
    else
    {
      echo "error";
    }
  }


    public function addAdmin()
    {
    $admin = new \Model\AdminMdl();
    $admin->setANname($_POST['nachname']);
    $admin->setAVorname($_POST['vorname']);
    $admin->setAPw(md5($_POST['password1']));
    //In Datenbank schreiben
    $resource = new AdminMdl();
    $resource->insertAdmin($admin); 
    }




}

 