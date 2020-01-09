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
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue('id', $_SESSION['userId']);
        $stmt->bindValue('order_id', $orderId);
        $stmt->execute();
    }


//gibt es Bestellungen?
    public function isOrders(): bool
    {
        $base = new Base();
        $sql = "SELECT * FROM bestellungen WHERE u_id = :id";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue('id', $_SESSION['userId']);
        $stmt->execute();
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return true;
        }
        return false;
    }


// Alle JAhre und Monate in denen der user bestellt hat
    public function getUserOrderDates(): array
    {
        $base = new Base();
            $sql = "SELECT DISTINCT MONTH(datum) AS monat,YEAR(datum) as jahr ,u_id 
                    FROM bestellverwaltung as bv, bestellungen as b WHERE bv.order_id = b.order_id AND b.u_id = :uid";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue('uid', $_SESSION['userId']);
        $stmt->execute();
        $orderArray = array();
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $orders = new BestellungenModel();
            $orders->setYear($row['jahr']);
            $orders->setMonth($row['monat']);

            $orderArray[] = $orders;
        }
        return $orderArray;
    }

//order ids in betreffenden Monaten
    public function getOrderIds($monat, $jahr)
    {
        $base = new Base();
        $sql = "SELECT DISTINCT order_id FROM bestellungen WHERE monat=:monat AND jahr=:jahr AND u_id = :id";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue('id', $_SESSION['userId']);
        $stmt->bindValue('monat', $monat);
        $stmt->bindValue('jahr', $jahr);
        $stmt->execute();
        $idArray = array();
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $orders = new BestellungenModel();
            $orders->setOrderId($row['order_id']);
            $idArray[] = $orders;
        }
        return $idArray;
    }

    //order-Id ovon bestellungen in diesem Jahr array in array
    public function getBestellungen($monat, $jahr)
    {
        $base = new Base();
        $sql = "SELECT i.*,b.*, bv.datum FROM bestellungen AS b 
                JOIN bestellverwaltung AS bv ON b.order_id = bv.order_id
                JOIN items AS i ON i.id =b.item_id WHERE YEAR(bv.datum) = :jahr 
                AND MONTH(bv.datum) = :monat  AND b.b_gesperrt =0";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue('monat', $monat);
        $stmt->bindValue('jahr', $jahr);
        $stmt->execute();
        $orderArray = array();
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $orderId = $row['order_id'];
            //neues array, um Bestellungen unter einen id zusammenfassen zu koennen
            if (!array_key_exists($orderId, $orderArray)) {
                $orderArray[$orderId] = [];
            }
            $order = new BestellungenModel();
            $order->setDatum($row['datum']);
            $order->setItemId($row['item_id']);
            $order->setMenge($row['menge']);
            $order->setPNameD($row['name_de']);
            $order->setPNameE($row['name_en']);
            $order->setPreis($row['preis']);
            $orderArray[$orderId][] = $order;
        }
        return $orderArray;
    }


    //alle Jahre und Monate in denen etwas bestellt wurde: einfaches Array
    public function getOrderDates(): array
    {
        $base = new Base();
        $sql = "SELECT DISTINCT YEAR(datum) AS year, MONTH(datum) AS month FROM bestellverwaltung ";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        //id des eingegebenen eintrags zurueckgeben.
        $stmt->execute();
        $date = array();
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $model = new BestellungenModel();
            $model->setYear($row['year']);
            $model->setMonth($row['month']);
            $date[] = $model;
        }
        return $date;
    }


    //alle bestellungen zu dieser ID wo bestellung nicht gesperrt wurden
    public function getBestellungById($orderId): array
    {
        $base = new Base();
        $sql = "SELECT * FROM items 
                JOIN bestellungen ON item_id = bestellungen.item_id 
                JOIN bestellverwaltung ON bestellungen.order_id = bestellverwaltung.order_id 
                WHERE bestellungen.order_id = :orderId AND b_gesperrt = 0";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue('orderId', $orderId);
        $stmt->execute();
        $orderArray = array();
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $order = new BestellungenModel();
            $order->setDatum($row['datum']);
            $order->setItemId($row['item_id']);
            $order->setMenge($row['menge']);
            $order->setPNameD($row['name_de']);
            $order->setPNameE($row['name_en']);
            $order->setPreis($row['preis']);
            $order->setOrderId($row['order_id']);
            $orderArray[] = $order;
        }
        return $orderArray;
    }

    //alle ebstellungen aus einem betsimmten jahr und monat
    public function getOrders($month, $year): array
    {
        $base = new Base();
        $sql = "SELECT *, b.b_gesperrt  FROM `bestellverwaltung` AS bv 
                JOIN bestellungen AS b ON bv.order_id = b.order_id
                JOIN items AS i ON b.item_id = i.id
                JOIN user AS u ON u.id = b.u_id
                WHERE MONTH(datum) = :monat AND YEAR(datum)= :jahr 
                ORDER BY datum DESC";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue('monat', $month);
        $stmt->bindValue('jahr', $year);
        $stmt->execute();
        $orderArray = array();
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $orders = new BestellungenModel();
            $orders->setMenge($row['menge']);
            $orders->setDatum($row['datum']);
            $orders->setItemId($row['item_id']);
            $orders->setPNameD($row['name_de']);
            $orders->setPNameE($row['name_en']);
            $orders->setPreis($row['preis']);
            $orders->setOrderId($row['order_id']);
            $orders->setUsername($row['username']);
            $orders->setGesperrt($row['b_gesperrt']);

            $orderArray[] = $orders;
        }
        return $orderArray;
    }

    //Eine Bestellung sperren, kundenID nicht benoetigt.
    public function lockOrder($order_id)
    {
        $base = new Base();
        $sql = "UPDATE bestellungen SET b_gesperrt = 1 WHERE order_id = ?";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->execute([$order_id]);
    }

    //eine Bestellung entsperren
    //Eine Bestellung sperren, kundenID nicht benoetigt.
    public function unlockOrder($order_id)
    {
        $base = new Base();
        $sql = "UPDATE bestellungen SET b_gesperrt = NULL WHERE order_id = ?";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->execute([$order_id]);
    }
}