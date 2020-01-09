<?php
namespace Model\Resource;
use \Model\AdminMdl as AdminModel;
class AdminMdl extends Base
{
    public function adminExists($vname,$nname)
    {
        $base= new Base();
        $sql = "SELECT a_nname,a_vorname FROM admin WHERE a_vorname = :vorname AND a_nname = :nachname";
        $stmt = $base->connect()->prepare($sql);
        //Werte zuweisen
        $stmt->bindValue(':vorname',$vname);
        $stmt->bindValue(':nachname',$nname);
        $stmt->execute();
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
        {
            return true;

        }
        return false;

    }
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

         public function authenticateAdmin($vorname,$nachname,$pwmd5)
        {/*Nutzer darf angemeldet werden wenn:
        *   -von Admin authorisiert wurde
        *  - nicht gesperrt ist(wird in Controller abgefragt)
        *  - Ein passender Eintrag in Db ist.
        */
        $sql = "SELECT a_id,a_nname,a_vorname,a_pwmd5,gesperrt,superAdmin FROM admin
                WHERE a_nname = :a_nname AND a_vorname = :a_vorname AND a_pwmd5 = :a_pwmd5";
        $base = new Base();
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        //Werte zuweisen
            $stmt->bindValue('a_nname', $nachname);
        $stmt->bindValue('a_vorname', $vorname);
        $stmt->bindValue('a_pwmd5', $pwmd5);
        $stmt->execute();
        while($row =$stmt->fetch(\PDO::FETCH_ASSOC)) {
            //Instanzierung der Klasse UserMdl in Model/UserMdl.php (setters und Getters)
            $admin  = new AdminModel();
            $admin->setStatus($row['gesperrt']);
            $admin->setSuper($row['superAdmin']);
            $admin->setAVorname($row['a_vorname']);
            $admin->setANname($row['a_nname']);
            $admin->setAId($row['a_id']);
            //Objekt
            return $admin;
        }
        //kein Admin gefunden
        return false;
        }

        //update passwort, wenn passwort geaedndert wurde
        public function updatePasswort($pwNeu,$adminId):void
    {
        $base= new Base();
        $sql ="UPDATE user SET pwmd5 = ? WHERE id = ?";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->execute(array(md5($pwNeu),$adminId));
    }


        //stimmt das eingegebne PAsswort? -> wir euebrprueft bei aendernd es eigenen Pw.
    public function isPassword($pw,$id)
    {
        $sql = "SELECT a_pwmd5 FROM admin WHERE a_pwmd5 = :pw AND a_id = :id";
        $base = new Base();
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        //Werte zuweisen
        $stmt->bindValue('pw', md5($pw));
        $stmt->bindValue('id', $id);
        $stmt->execute();
        return $row =$stmt->fetch(\PDO::FETCH_ASSOC);

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
                $admin->setStatus("locked");
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
    public function insertAdmin($nachname,$vorname,$pw)
    {
        $base= new Base();
        $sql = "INSERT INTO admin(a_nname,a_vorname,a_pwmd5) 
        VALUES(:nachname,:vorname,:pwmd5)";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        //Werte zuweisen
        $stmt->bindValue(':vorname', $vorname);
        $stmt->bindValue(':nachname',$nachname);
        $stmt->bindValue(':pwmd5',   md5($pw));
        $stmt->execute();

    }

    public function getAdminById($id):AdminModel
    {
        $base= new Base();
        $sql = "SELECT a_vorname, a_nname,gesperrt,superAdmin,a_pwmd5 From admin WHERE a_id = :id";
        $stmt = $base->connect()->prepare($sql);
        //Werte zuweisen
        $stmt->bindValue(':id',$id);
        $stmt->execute();
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
        {
            //Daten an Model/Admin.php (setters und Getters) uebergeben
            $admin = new AdminModel();
            $admin->setSuper($row['superAdmin']);
            $admin->setANname($row['a_nname']);
            $admin->setAVorname($row['a_vorname']);
            $admin->setAPw($row['a_pwmd5']);
            $admin->setStatus($row['gesperrt']);


           return $admin;
        }
      return false;
    }

    //Gibt es diesen Administrator schon?
    public function verifyNewFirst($edit,$curName):bool
    {
        $base = new base();
        $sql="SELECT * FROM admin WHERE a_nname = :nachname AND a_vorname = :vorname";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':nachname',$curName);
        $stmt->bindValue(':vorname',$edit);
        $stmt->execute();
        //wenn es Ergebnisse gibt : return true
        while ( $row = $stmt->fetch(\PDO::FETCH_ASSOC) )
        {
            return true;
        }
        return false;
    }

    //Gibt es diesen Administrator schon?
    public function verifyNewLast($edit,$curName):bool
    {
        $base = new base();
        $sql="SELECT * FROM admin WHERE a_nname = :nachname AND a_vorname = :vorname";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':nachname',$edit);
        $stmt->bindValue(':vorname',$curName);
        $stmt->execute();
        //wenn es Ergebnisse gibt : return true
        while ( $row = $stmt->fetch(\PDO::FETCH_ASSOC) )
        {
            return true;
        }
        return false;
    }

    /*Admininformationen aktualisieren*/
    public function updateAdmin($id,$row,$edit)
    {
        $base= new Base();
        $sql ="UPDATE admin SET $row = ? WHERE a_id = ?";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->execute(array($row=$edit,$id));
    }

}