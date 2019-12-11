<?php
namespace Controller;
use \Model\Resource\AdminMdl;
use App;

class AdminCtrl 
{	
	public $name;
	public $nachname;
	public $password;
	public $errorArray = array();
  public function verifyAdmin()
  {
     if(isset($_SESSION['admin']) && App::adminSess())
  { 
    return true;
  }
  }

  // public function showErrors()
  //  {
  //  	 foreach ($this->errorArray as $value)
  //   {
  //   //Fehler ausgeben
  //   include BASEPATH.'/app/includes/languageCheck.php';
  //   return  $langArray[$opt][$value];
  //   }
  // }

    public function tryLogin($name,$nachname,$password)
    { 
    $adminArray = AdminMdl::authorizeAdmin();
    foreach ($adminArray as $key)
	 {
			$pass = $key->getAPw();
			$a_name = $key->getAVorname();
			$a_nachname = $key->getANname();
		}
    
    if(empty($this->name) && empty($this->nachname) && empty($this->pw))
	{
	$this->errorArray[] = "emptyFields";
	return $this->errorArray;
	}
	elseif ($this->name !== $a_name)
	{
		$this->errorArray[]= "nameNot";
		return $this->errorArray;
	}
	elseif ($this->nachname !== $a_nachname)
	{
		$this->errorArray[]= "nameNot";
		return $this->errorArray;
	}
	elseif(md5($this->password) !== $pass)
	{
		$this->errorArray[]= "pwNot";
		return $this->errorArray;
	}
	if(!empty($this->errorArray))
   {
    return $this->errorArray;
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
     /* wenn Login fehlschlägt, gib Fehler aus, sonst starte Adminsession und weiterleiten auf Dashboard*/
    
    // if(self::tryLogin($name,$nachname,$password))
    //   {echo "fehhler";}
    // else
    //   {     
      $_SESSION['admin'] = "loggedIn";
      //Anmeldung erfolgreich, weiterleiten zum Admin dashboard
      echo "<script> window.location.href = \"admin-home\"</script>";
      // }
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
}

 