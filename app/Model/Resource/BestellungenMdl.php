<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 30.12.2019
 * Time: 18:30
 */
namespace Model\Resource;


use Model\BestellungenMdl as BestellungenModel;


class BestellungenMdl extends Base
{
    //Bestellung in  bestellungen schreiben und aus warenkorb loeschen
    //DANKE:https://stackoverflow.com/questions/27464309/how-to-insert-from-one-table-into-another-with-extra-values-in-sql
    public function placeOrder()
    {
        $base = new Base();
        $sql = "INSERT INTO bestellungen (u_id,monat,jahr,bestelldatum,item_id,menge)
                SELECT user_id,MONTH(CURRENT_DATE()),YEAR(CURRENT_DATE()),CURRENT_DATE(),item_id,menge FROM cart WHERE user_id=:id;
                DELETE FROM cart WHERE user_id=:id";
        $connection=$base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue('id',$_SESSION['userId']);
        $stmt->execute();
    }
public function getAllOpenOrders()
{
    echo 'getallopenorder';
}

public function isOrders():bool
{
    $base = new Base();
    $sql = "SELECT * FROM bestellungen WHERE u_id = :id";
    $connection=$base->connect();
    $stmt = $connection->prepare($sql);
    $stmt->bindValue('id',$_SESSION['userId']);
    $stmt->execute();
    while($row = $stmt->fetch(\PDO::FETCH_ASSOC))
    {return true;}
    return false;
}
// Daten fuer anzeige nach Bestelljahr und Monat
public function getUserOrderDates():array
{
    $base = new Base();
    $sql = "SELECT DISTINCT jahr,monat FROM bestellungen WHERE u_id = :id";
    $connection=$base->connect();
    $stmt = $connection->prepare($sql);
    $stmt->bindValue('id',$_SESSION['userId']);
    $stmt->execute();
    $orderArray = array();
    while($row = $stmt->fetch(\PDO::FETCH_ASSOC))
    {
        $orders= new BestellungenModel();
        $orders->setYear($row['jahr']);
        $orders->setMonth($row['monat']);
        $orderArray[]=$orders;
    }
    return $orderArray;
}

    //Bestellungen nach angeforderter Datumsanzeige absteigend inklusive Produktinformationen aus items tabelle
    public function getOrdersByDate($jahr,$monat)
    {

        $base = new Base();
        $sql = "SELECT * FROM bestellungen 
                INNER JOIN items ON item_id = id 
                WHERE bestelldatum =
                (SELECT DISTINCT bestelldatum 
                FROM bestellungen WHERE jahr =:jahr AND monat=:monat AND u_id =:id
                GROUP BY bestelldatum)
                AND u_id = :id";
        $connection=$base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue('monat',$monat);
        $stmt->bindValue('jahr',$jahr);
        $stmt->bindValue('id',$_SESSION['userId']);
        $stmt->execute();
        $orderArray = array();
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC))
        {
            $orders= new BestellungenModel();
            $orders->setDatum($row['bestelldatum']);
            $orders->setOrderId($row['order_id']);
            $orders->setMenge($row['menge']);
            $orders->setPNameD($row['name_de']);
            $orders->setPNameE($row['name_en']);
            $orders->setPreis($row['preis']);
            $orderArray[]=$orders;
        }
        return $orderArray;
    }


}