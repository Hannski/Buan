<?php
namespace Controller;
use \Model\Resource\AdminMdl;
class Admin 
{
	function __construct()
	{
		include BASEPATH."/app/LanguageCheck.php";
	}
	public $name  = "";
	public $pw    = "";
	public $errorArray = array();
	
public function login($name,$pw)
{
	$this->name = $_POST['name'];
    $this->pw  = $_POST['password'];
	$adminArray = AdminMdl::authorizeAdmin($name,$pw);
	foreach ($adminArray as $key){
			$pass = $key->getAPw();
			$aName = $key->getANname();
		}

	if ($this->name == "" && $this->pw =="")
	{
		$this->errorArray[] = "emptyFields";
	}
	elseif ($this->name !== $aName)
	{
		$this->errorArray[]= "nameNot";
	}
	elseif($this->pw !== $pass) {
		$this->errorArray[]= "pwNot";
	}
	
}	


}

 