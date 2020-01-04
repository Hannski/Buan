<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 02.01.2020
 * Time: 19:23
 */

namespace Model\Resource;
use Model\UserAdressenMdl;

class AdressMdl extends Base
{
    //addressdaten eines Nutzer nach id abrufen
    public function getUserAddress($userId):array
    {
        //datenbank verbindung

        $sql = "SELECT *
                From useradressen 
                WHERE u_id = :id";
        $base = new Base();
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        //Werte zuweisen
        $stmt->bindValue('id',$userId);
        $stmt->execute();
        $addressArray = array();
        while($row =$stmt->fetch(\PDO::FETCH_ASSOC)) {

            //Instanzierung der Klasse UserMdl in Model/UserMdl.php (setters und Getters)
            $address = new UserAdressenMdl();
            $address->setVorname($row['vorname']);
            $address->setNachname($row['nachname']);
            $address->setStrasse($row['strasse']);
            $address->setNummer($row['nummer']);
            $address->setPlz($row['plz']);
            $address->setOrt($row['ort']);
            $address->setLand($row['land']);
            //Objekt
            $addressArray[]= $address;
        }
        return $addressArray;

    }

    //gibt es zu diesem Nutzer schon addressdaten?
    public function isAddress($userId):bool
    {
        $sql = "SELECT * FROM useradressen WHERE u_id = :uid";
        $base = new Base();
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        //Werte zuweisen
        $stmt->bindValue(':uid', $userId);
        $stmt->execute();
        $adressArray = array();
        while($row =$stmt->fetch(\PDO::FETCH_ASSOC))
        {
            return true;
        }
        return false;
    }

    //Adressinformationen aktualisieren
    public function updateAddress()
    {
        $sql = "UPDATE useradressen SET vorname=:vorname,nachname=:nachname,strasse=:strasse,plz=:plz,ort=:ort,nummer=:nummer,land=:land
                WHERE u_id = :uid";
        $base = new Base();
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        //Werte zuweisen
        $stmt->bindValue('uid', $_SESSION['userId']);
        $stmt->bindValue('vorname', $_POST['vorname']);
        $stmt->bindValue('nachname', $_POST['nachname']);
        $stmt->bindValue('strasse', $_POST['strasse']);
        $stmt->bindValue('plz', $_POST['plz']);
        $stmt->bindValue('nummer', $_POST['nummer']);
        $stmt->bindValue('ort', $_POST['ort']);
        $stmt->bindValue('land', $_POST['land']);
        $stmt->execute();
    }

    //Adresse einfuegen
    public function insertAddress()
    {
        $base = new Base();
        $connection = $base->connect();
        $sql = "INSERT INTO useradressen (vorname,nachname,strasse,plz,ort,nummer,land,u_id)
                VALUES (:vorname,:nachname,:strasse,:plz,:ort,:nummer,:land,:u_id)";
        $stmt = $connection->prepare($sql);
        //Werte zuweisen
        $stmt->bindValue('u_id', $_SESSION['userId']);
        $stmt->bindValue('vorname', $_POST['vorname']);
        $stmt->bindValue('nachname', $_POST['nachname']);
        $stmt->bindValue('strasse', $_POST['strasse']);
        $stmt->bindValue('plz', $_POST['plz']);
        $stmt->bindValue('nummer', $_POST['nummer']);
        $stmt->bindValue('ort', $_POST['ort']);
        $stmt->bindValue('land', $_POST['land']);
        return $stmt->execute();

    }


}