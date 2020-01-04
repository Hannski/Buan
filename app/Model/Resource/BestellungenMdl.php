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
    public function placeOrder($orderId)
    {
        $base = new Base();
        $sql = "INSERT INTO bestellungen
                (order_id,u_id,monat,jahr,bestelldatum,item_id,menge)
                SELECT :order_id,user_id,MONTH(CURRENT_DATE()),YEAR(CURRENT_DATE()),CURRENT_DATE(),item_id,menge FROM cart WHERE user_id=:id;
                DELETE FROM cart WHERE user_id=:id";
        $connection=$base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue('id',$_SESSION['userId']);
        $stmt->bindValue('order_id',$orderId);
        $stmt->execute();
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



// Alle JAhre und Monate in denen der user bestellt hat
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

//order ids in betreffenden Monatn
public function getOrderIds($monat,$jahr)
{
    $base = new Base();
    $sql = "SELECT DISTINCT order_id FROM bestellungen WHERE monat=:monat AND jahr=:jahr AND u_id = :id";
    $connection=$base->connect();
    $stmt = $connection->prepare($sql);
    $stmt->bindValue('id',$_SESSION['userId']);
    $stmt->bindValue('monat',$monat);
    $stmt->bindValue('jahr',$jahr);
    $stmt->execute();
    $idArray = array();
    while($row = $stmt->fetch(\PDO::FETCH_ASSOC))
    {
        $orders= new BestellungenModel();
        $orders->setOrderId($row['order_id']);
        $idArray[]=$orders;
    }
    return $idArray;
}

    //oder Id ovon bestellungen in diesem Jahr
    public function getBestellungen($monat,$jahr)
    {
        $base = new Base();
        $sql = "SELECT order_id,GROUP_CONCAT('item:',item_id,'-','menge:',menge)AS json_item FROM bestellungen
                  WHERE u_id = :uid AND monat=:monat AND jahr=:jahr GROUP BY order_id";
        $connection=$base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue('uid',$_SESSION['userId']);
        $stmt->bindValue('monat',$monat);
        $stmt->bindValue('jahr',$jahr);
        $stmt->execute();
        $orderArray = array();
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC))
        {
               $order_id=($row['order_id']);
               $json_item=($row['json_item']);
               $orderArray[]=$order_id;
               $orderArray[]=$json_item;

        }
        return $orderArray;
    }


}