<?php
namespace Model\Resource;
use Model\UserAdressenMdl;
use Model\UserMdl as UserModel;
class UserMdl extends Base
{

    //update user
    /*admin  aktualisiert user-infos*/
    public function updateUser($id,$edit,$value)
    {
        $base= new Base();
        $sql ="UPDATE user SET $edit = ? WHERE id = ?";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->execute([$edit=$value,$id]);
    }

    //userModel zurueckgeben mit allen Daten zum user.
    public function getUserById($id):UserModel
    {
        $sql = "SELECT * FROM user WHERE id = :id";
        $base = new Base();
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        //Werte zuweisen
        $stmt->bindValue(':id', $id);
        $stmt->execute();
            $row =$stmt->fetch(\PDO::FETCH_ASSOC);
            $user = new UserModel();
            $user->setUsername($row['username']);
            $user->setAcceptiondate($row['confirm_datum']);
            $user->setAppMsg($row['msg']);
            $user->setTemppw($row['temp_pw']);
            if ($row['gesperrt']==0)
            {
                $user->setStatus('aktiv');
            }else
            {
                $user->setStatus('gesperrt');
            }
            return $user;
    }


    //gibt es diesen Usernamen?
    public function isUsername($username):bool
    {
        $sql = "SELECT username FROM user WHERE username = :username ";
        $base = new Base();
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        //Werte zuweisen
        $stmt->bindValue('username', $username);
        $stmt->execute();
        while($row =$stmt->fetch(\PDO::FETCH_ASSOC)){
            return true;
        }
        return false;
    }

    //temporaeres Passwort, wenn user passswort vergessen vorgang gewahlt hat
    public function insertTempPw($tempPass,$username):void
    {
        $base= new Base();
        $sql = "UPDATE user set temp_pw = :tempPw WHERE username = :username";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        //md5 verschluesselung des temporaeren Passwortes.
        $stmt->bindValue('tempPw',md5($tempPass));
        $stmt->bindValue('username',$username);
        $stmt->execute();
    }

    //befindet sich dieser user in einem Password-recovery Vorgang?
    // -hat kein temp_passwort
    // -hat kein pw
    public function isUserRecovery($id):bool
    {
        $base = new Base();
        $sql = "SELECT COUNT(id) AS counter FROM user WHERE pwmd5 IS NULL AND temp_pw IS NULL AND id=?";
        $stmt = $base->connect()->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row['counter'] == 1;

    }

    //User mit bestimmten usernamen sperren
    public function lockUsername($username):void
    {
        $sql = "UPDATE user SET gesperrt = 1, pwmd5 = NULL WHERE username = :username ";
        $base = new Base();
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        //Werte zuweisen
        $stmt->bindValue('username', $username);
        $stmt->execute();
    }

    //User Adresse holen
    public function getUserAdress($userId):array
    {
        $sql = "SELECT strasse,nummer,plz,ort,land FROM useradressen WHERE u_id = :uid";
        $base = new Base();
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        //Werte zuweisen
        $stmt->bindValue(':uid', $userId);
        $stmt->execute();
        $adressArray = array();
        while($row =$stmt->fetch(\PDO::FETCH_ASSOC))
        {
            $adress = new UserAdressenMdl();
            $adress->setStrasse($row['strasse']);
            $adress->setNummer($row['nummer']);
            $adress->setOrt($row['ort']);
            $adress->setPlz($row['plz']);
            $adress->setLand($row['land']);
            $adressArray[]= $adress;
        }
        return $adressArray;
    }


    //ist der username bereits vergeben und nicht der aktuelle Username??
    public function isNewUsername($username,$id):bool
    {
        $sql = "SELECT username FROM user WHERE username = :username AND id != :id";
        $base = new Base();
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        //Werte zuweisen
        $stmt->bindValue('username', $username);
        $stmt->bindValue('id', $id);
        $stmt->execute();
        while($row =$stmt->fetch(\PDO::FETCH_ASSOC)){
            return true;
        }
        return false;
    }

    //stimmt das eingegebne passwort?
    public function isPassword($password,$id):bool
    {
        $sql = "SELECT pwmd5 FROM user WHERE pwmd5 = :password AND id=:id";
        $base = new Base();
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        //Werte zuweisen + passwort hashen
        $stmt->bindValue('password', md5($password));
        $stmt->bindValue('id', $id);
        $stmt->execute();
        while($row =$stmt->fetch(\PDO::FETCH_ASSOC)){
            return true;
        }
        return false;
    }



    //Passwort aktualisieren
    public function updatePasswort($pwNeu,$id)
    {
        $base= new Base();
        $sql ="UPDATE user SET pwmd5 = ? WHERE id = ?";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->execute(array(md5($pwNeu),$id));
    }
    //Username aktualisieren
    public function updateUsername($username,$id)
    {
        $base= new Base();
        $sql ="UPDATE user SET username = ? WHERE id = ?";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->execute(array($username,$id));
    }

    /*User authetifizierung */
	public function authenticateUser($username,$password)
    {
        /*Nutzer darf angemeldet werden wenn:
        *   -von Admin authorisiert wurde
        *  - nicht gesperrt ist(wird in Controller abgefragt)
        *  - Ein passender Eintrag in Db ist.
         * -gesperrt ist aber ein gueltiges recovery Passwort eingegeben hat
        */
        $sql = "SELECT id,username,pwmd5,gesperrt FROM user
                WHERE username = :username AND ((pwmd5 = :pwmd5 AND gesperrt=0) OR (temp_pw =:pwmd5 AND gesperrt=1))
                AND confirm_datum > 0000-00-00";
        $base = new Base();
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        //Werte zuweisen
        $stmt->bindValue('username', $username);
        $stmt->bindValue('pwmd5', $password);
        $stmt->execute();
        while($row =$stmt->fetch(\PDO::FETCH_ASSOC)) {
            //Instanzierung der Klasse UserMdl in Model/UserMdl.php (setters und Getters)
            $user = new UserModel();
            $user->setUsername($row['username']);
            $user->setPwmd5($row['pwmd5']);
            $user->setId($row['id']);
            $user->setStatus($row['gesperrt']);
            //Objekt
            return $user;
        }
        //kein Nutzer gefunden
        return false;
    }
    /*neuen User (noch nicht authorisiert) in die Datenbank schreiben: diesen Nutzenden zeichent aus,
    dass er oder sie gesperrt sind und kein konfirmations-datum festgelet wird*/
    public function insertUser($user)
    {
        $base= new Base();
        $sql = "INSERT INTO user(username,pwmd5,confirm_datum,gesperrt,msg)
        VALUES(:username,:pwmd5,:confirm_datum,:gesperrt,:msg)";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        //Werte zuweisen

        $stmt->bindValue('username', $user->getUsername());
        $stmt->bindValue('pwmd5',    $user->getPwmd5());
        $stmt->bindValue('gesperrt', $user->getStatus());
        $stmt->bindValue(':msg',     $user->getAppMsg());
        $stmt->bindValue(':confirm_datum', '0000-00-00');
        $stmt->execute();

    }

   /*unauthoriserte Nutzer fuer die Ansicht im Admindashboard: noch kein Confirm_Datum*/
    public function getUnauthUsers():array
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
    public function authUser($id,$status)
    {
    $base  = new Base();
    $sql  = "UPDATE  user SET confirm_datum = CURRENT_DATE(), gesperrt=:gesperrt WHERE id=:id";
    $connection = $base->connect();
    $stmt= $connection->prepare($sql);
    $stmt->bindValue(':id',$id);
    $stmt->bindValue(':gesperrt',$status);
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

        //gesperrten user mit temporarerem Passwort weder freischalten und temporaeres Passwort loeschen
    public function unlockUser($id)
    {
        $base  = new Base();
        $sql = "UPDATE user SET gesperrt = 0, temp_pw = NULL WHERE id=?";
        $stmt  = $base->connect()->prepare($sql);
        $stmt->execute([$id]);
    }
}