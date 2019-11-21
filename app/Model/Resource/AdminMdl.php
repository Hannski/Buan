<?php
namespace Model\Resource;
use Model\AdminMdl as AdminModel;
class AdminMdl extends Base
{
	public function authorizeAdmin()
    {
        $base= new Base();
        $sql = "SELECT a_id,a_nname,a_vorname,a_pwmd5 FROM admin";
        $dbResult = $base->connect()->query($sql);
        $adminArray = array();
        while ($row = $dbResult->fetch(\PDO::FETCH_ASSOC))
        {
            //Instanzierung der Klasse Produkt in Model/Produkt.php (setters und Getters)
            $admin = new AdminModel();
            $admin->setAId($row['a_id']);
            $admin->setANname($row['a_nname']);
            $admin->setAVorname($row['a_vorname']);
            $admin->setAPw($row['a_pwmd5']);

            //Ins array schreiben
            $adminArray[] = $admin;
        }
        return $adminArray;
    }

}