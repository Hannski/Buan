<?php
namespace Model\Resource;
use Model\AdminMdl as AdminModel;
class AdminMdl extends Base
{
    /*
    *Fuer abgleich der eingegeben Anmeldedaten : vergleichswerte aus der DB beziehen
    *    -Passwort(md5-verschluesselt)
    *    -vorname
    *    -nachname
    *  Fuer abfrage ob superAdmin oder nicht:
    *    -status
    */
	public function authorizeAdmin($vname,$nname,$pw)
    {
          $base= new Base();

        $sql = "SELECT a_id,a_nname,a_vorname,gesperrt,superAdmin FROM admin WHERE a_vorname = :vorname AND a_nname = :nachname AND a_pwmd5 = :pw";
        
        $stmt = $base->connect()->prepare($sql);
        //Werte zuweisen
        $stmt->bindValue(':vorname',$vname);
        $stmt->bindValue(':nachname',$nname);
        $stmt->bindValue(':pw',$pw);
        $stmt->execute();
   
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
        {
            //Daten an Model/Admin.php (setters und Getters) uebergeben
            $admin = new AdminModel();
            $admin->setANname($row['a_nname']);
            $admin->setAVorname($row['a_vorname']);
            $admin->setStatus($row['gesperrt']);
            $admin->setSuper($row['superAdmin']);
            return $admin;
            $_SESSION['adminId'] = $row['a_id'];
        }
        return false;
    }



    /*
    * Alle Administratoren aus der Db abrufen fuer Administratorenverwaltung
    *   -Ausgenommen SuperAdmin
    */
    public function getAllAdmins()
    {
        $base= new Base();
        $sql = "SELECT a_id,a_nname,a_vorname,a_pwmd5,gesperrt FROM admin WHERE superAdmin=0";
        $dbResult = $base->connect()->query($sql);
        $adminArray = array();
        while ($row = $dbResult->fetch(\PDO::FETCH_ASSOC))
        {
            //Daten an Model/Admin.php (setters und Getters) uebergeben
            $admin = new AdminModel();
            $admin->setAId($row['a_id']);
            $admin->setANname($row['a_nname']);
            $admin->setAVorname($row['a_vorname']);
            $admin->setAPw($row['a_pwmd5']);
            if ($row['gesperrt']==0)
            {
                $admin->setStatus("aktiv"); 
            }
            else
            {
                $admin->setStatus("gesperrt");
            }
           

            //Ins array schreiben
            $adminArray[] = $admin;
        }
        return $adminArray;
    }
    
    /*
    *Einen neuen Administratoren in die Db eintragen
    *   -Vorname
    *   -Nachname
    *   -Passwort (md5-verschluesselt)
    */
    public function insertAdmin($admin)
    {
        $base= new Base();
        $sql = "INSERT INTO admin(a_nname,a_vorname,a_pwmd5) 
        VALUES(:vorname,:nachname,:pwmd5)";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        //Werte zuweisen
        $stmt->bindValue(':vorname', $admin->getAVorname());
        $stmt->bindValue(':nachname',    $admin->getANname());
        $stmt->bindValue(':pwmd5', $admin->getAPw());
        $stmt->execute();

    }


}