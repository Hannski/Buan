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
                (order_id,u_id,item_id,menge)
                SELECT :order_id,user_id,item_id,menge FROM cart WHERE user_id=:id;
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
    $sql = "SELECT DISTINCT MONTH(datum) AS monat,YEAR(datum) AS jahr FROM bestellverwaltung WHERE user_id = :id";
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
        $sql = "SELECT i.*,b.*, bv.datum FROM bestellungen AS b JOIN bestellverwaltung AS bv ON b.order_id = bv.order_id JOIN items AS i ON i.id =b.item_id WHERE YEAR(bv.datum) = :jahr AND MONTH(bv.datum) = :monat AND bv.user_id=:uid";
        $connection=$base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue('uid',$_SESSION['userId']);
        $stmt->bindValue('monat',$monat);
        $stmt->bindValue('jahr',$jahr);
        $stmt->execute();
        $orderArray = array();
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC))
        {
            $orderId = $row['order_id'];
            //neues array, um Bestellungen unter einen id zusammenfassen zu koennen
            if (!array_key_exists($orderId, $orderArray))
            {
                $orderArray[$orderId] = [];
            }
              $order= new BestellungenModel();
              $order->setDatum($row['datum']);
              $order->setItemId($row['item_id']);
              $order->setMenge($row['menge']);
              $order->setPNameD($row['name_de']);
              $orderArray[$orderId][] = $order;
        }
        return $orderArray;
    }


}