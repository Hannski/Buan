<?php
namespace Controller;
use \Model\Resource\AdminMdl;
use App;

class AdminCtrl 
{	
  public $a_id="";
	public $name="";
	public $nachname="";
	public $password="";
  public $status="";
	

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
  
  
  /*handelt es sich bei dem eingeloggten Admin um den Super Admin? */
  public function isSuperAdmin()
  {
    if(isset($_SESSION['super'])=="super") 
    {
      return true;
    }
    else
    {
      return false;
    }
  }

   /*Ist der Admin eingeloggt? */
   //Sessions verwalten:
  public function isAdmin()
  {
    if(isset($_SESSION['admin']) == "loggedIn")
    {

      return true;
    }
    else
    {

      return false;
    }
  }
  public function returnAdminStatus()
  {
    if(self::isSuperAdmin())
    {
      return "superAdminDashboard";
    }
    elseif (self::isAdmin())
    {
      return "adminDashboard";
    }
    else
    {
      return false;
    }
  }



  public function loginAdmin()
   {
     /* wenn isPost aus app/App.php, also Post-request gestellt dann login Vorgang starten*/
    if(isset($_POST['a_login']))
    {
     $name     = $_POST['name'];
     $nachname = $_POST['nachname'];
     $password = $_POST['password'];
    
     $_SESSION['admin'] = "loggedIn";
      
      echo "<script> window.location.href = \"admin-home\"</script>";
   
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







    /*
  * Formularfehler abfangen
  *-Alle Felder muessen ausgefuellt werden
  *-Passwoerter bestimme laenge
  *-PAsswoerter stimmen ueberein
  *-
  */
    public function addAdminForm()
    {
      return true;
    }
        /*
  * Formularfehler abfangen
  *-Alle Felder muessen ausgefuellt werden
  *-Passwoerter bestimme laenge
  *-PAsswoerter stimmen ueberein
  *-
  */
    public function addAdmin()
    {
    $admin = App::getModel('AdminMdl');
    $admin->setANname($_POST['nachname']);
    $admin->setAVorname($_POST['vorname']);
    $admin->setAPw(md5($_POST['password1']));
    //In Datenbank schreiben
    $resource = App::getResourceModel('AdminMdl');
    $resource->insertAdmin($admin); 
    }
  /*
  *Alle Administratoren abrufen 
  * - mit Ausnahme von Superadmin
  *
  */
  public function showAllSubAdmins()
  {
      // resource model instanzieren  
        $model = App::getResourceModel('AdminMdl');
        //Daten abrufen
        $adminArray = $model->getAllAdmins();
        // adminArray fuer Anzeige in Array bereitstellen
        return array('adminArray'=> $adminArray);
  }
}

 