<?php
namespace Controller;
use \Model\Resource\AdminMdl;
class AdminCtrl 
{
	function __construct()
	{
		include BASEPATH."/app/LanguageCheck.php";

	}
	public $name  = "";
	public $pw    = "";
	public $error = array();

public function login($name, $pw)
{
	if (empty($name)||empty($pw))
	{
		return "emptyFields";
	}
}
public function loginA($name,$pw)
{
	$model = new AdminMdl();
	$adminArray = $model->getA();
	
}

}
