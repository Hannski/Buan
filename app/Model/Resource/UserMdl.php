<?php
namespace Model\Resource;
use Model\UserMdl as UserModel;
class UserMdl extends Base
{
    /*User authetifizierung */
	public function authorizeUser()
    {
        $base= new Base();
        $sql = "SELECT id,username,pwmd5,gesperrt FROM user";
        $dbResult = $base->connect()->query($sql);
        $userArray = array();
        while ($row = $dbResult->fetch(\PDO::FETCH_ASSOC))
        {
            //Instanzierung der Klasse UserMdl in Model/UserMdl.php (setters und Getters)
            $user = new UserModel();
            $user->setId($row['id']);
            $user->setUsername($row['username']);
            $user->setPwmd5($row['pwmd5']);
            $user->setgesperrt($row['gesperrt']);

            //Ins array schreiben
            $userArray[] = $user;
        }
        return $userArray;
    }
    /*neuen User (noch nicht authorisiert) in die Datenbank schreiben: diesen Nutzenden zeichent aus, dass er oder sie gesperrt sind und kein konfirmations-datum festgelet wird*/
    public function insertUser($user)
    {
        $base= new Base();
        $sql = "INSERT INTO user(username,pwmd5,gesperrt,msg) 
        VALUES(:username,:pwmd5,:gesperrt,:msg)";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        //Werte zuweisen
        $stmt->bindValue('username', $user->getUsername());
        $stmt->bindValue('pwmd5',    $user->getPwmd5());
        $stmt->bindValue('gesperrt', $user->getStatus());
        $stmt->bindValue(':msg',     $user->getAppMsg());
        $stmt->execute();
    }

   /*unauthoriserte Nutzer fuer die Ansicht im Admindashboard: noch kein Confirm_Datum*/
    public function getUnauthUsers()
    {
        $base= new Base();
        $sql = "SELECT id,username,gesperrt,msg FROM user WHERE confirm_datum =0";
        $dbResult = $base->connect()->query($sql);
        $userArray = array();
        while ($row = $dbResult->fetch(\PDO::FETCH_ASSOC))
        {
            //Instanzierung der Klasse UserMdl in Model/UserMdl.php (setters und Getters)
            $user = new UserModel();
            $user->setId($row['id']);
            $user->setUsername($row['username']);
            $user->setStatus($row['gesperrt']);
            $user->setAppMsg($row['msg']);
            //Ins array schreiben
            $userArray[] = $user;
        }
        return $userArray;
    }
    /*
    wenn Admin User anerkannt hat: in Datenbank spersstatus aufheben:"gesperrt = 0, confirmationsdatum eintragen = Nutzer ist authorisiert
    */
    public function authUser($user)
    {
    $base  = new Base();
    $sql  = "UPDATE  user SET confirm_datum = CURRENT_DATE(), gesperrt=:gesperrt WHERE id=:id";
    $connection = $base->connect(); 
    $stmt= $connection->prepare($sql);
    $stmt->bindValue(':gesperrt', $user->getStatus());
    $stmt->bindValue(':id', $user->getId());
    $stmt->execute();
    }
     /*
    *Alle Authorisierten Nutzer aus der Datenbank:
    *-confirm_datum>0000-00-00
    */
    public function getAllAuthUsers()
    {
        $base= new Base();
        //Nur Produkte, die auf Lager sind anzeigen. 
        $sql = "SELECT id,username,confirm_datum,gesperrt FROM user WHERE confirm_datum > 0000-00-00";
        $dbResult = $base->connect()->query($sql);
        $userArray = array();
        while ($row = $dbResult->fetch(\PDO::FETCH_ASSOC))
        {
            //Instanzierung der Klasse User in Model/User.php (setters und Getters)
            $user = new UserModel();
            $user->setId($row['id']);
            $user->setUsername($row['username']);
            /*Datumsausgabe aus dem Format : Year-month-day zu: Tag.Monat.Jahr 8-stellig- 00.00.0000*/
            $date = date_create($row['confirm_datum']);            
            $user->setAcceptiondate(date_format($date,'d.m.Y'));
            $user->setStatus($row['gesperrt']);
            //Ins array schreiben
            $userArray[] = $user;
        }
        return $userArray;
    }



}