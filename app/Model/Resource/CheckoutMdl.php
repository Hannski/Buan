<?php

namespace Model\Resource;

use Model\CheckoutMdl as CheckoutModel;
use Model\WarenkorbMdl;

class CheckoutMdl extends Base
{
    //hat der user bereits diesen artikel in den warenkorb gelegt?
    public function itemInCart($item_id):bool
    {
        $base = new Base();
        $sql = "SELECT * FROM cart WHERE user_id = :user_id AND item_id = :item_id ";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':user_id', $_SESSION['userId']);
        $stmt->bindValue(':item_id', $item_id);
        $stmt->execute();
        //Ergebnis?
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return true;
        }
        //item noch nicht im Warenkorb
        return false;
    }

  //Produkt in Wraenkorb ablegen
    public function insertCart($menge,$itemId):void
    {
        $base = new Base();
        $sql = "INSERT INTO cart(item_id,user_id,menge) VALUES (:id,:userId,:menge)";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue('id', $itemId);
        $stmt->bindValue('userId', $_SESSION['userId']);
        $stmt->bindValue('menge', $menge);
        $stmt->execute();
    }

    //Produkt bereits im Warenkorb, Menge aktualisieren
    public function updateCart($menge, $itemId):void
    {
        $base = new Base();
        $sql = "UPDATE cart SET menge = menge + ?  WHERE user_id = ? AND item_id = ?";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->execute(array($menge, $_SESSION['userId'], $itemId));
    }

    //ist der Warenkorb leer?
    public function isCart($userId): bool
    {

        $base = new Base();
        $sql = "SELECT * FROM cart WHERE user_id = :id";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':id', $userId);
        $stmt->execute();
        $cartArray = array();
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return true;
        }
        return false;
    }

    //hole alles im Warenkorb
    public function getCart():array
    {

        $base = new Base();
        $sql = "SELECT * FROM items RIGHT JOIN cart ON items.id = cart.item_id WHERE user_id = :id";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':id', $_SESSION['userId']);
        $stmt->execute();
        $cartArray = array();
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $cart = new WarenkorbMdl();
            $cart->setItemId($row['item_id']);
            $cart->setNameDe($row['name_de']);
            $cart->setNameEn($row['name_en']);
            $cart->setMenge($row['menge']);
            $cart->setPreis($row['preis']);
            $cart->setDateiname($row['dateiname']);
            $cartArray[] = $cart;
        }
        return $cartArray;
    }

    //Usersession beendet: Lagerbestaende in tabelle 'items' wieder anpassen
    public function fixItemStock($userId):void
    {
        $base= new Base();
        $sql = "UPDATE items SET bestand= bestand +(SELECT menge FROM cart where items.id=cart.item_id AND user_id=:userId )
               WHERE (SELECT cart.item_id FROM cart )= items.id";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':userId', $_SESSION['userId']);
        $stmt->execute();
    }

    //Bestand der Produkte anpassen, wenn user im Warenkorb gewuenschre Produktanzahl aendert
    public function editStock($bestand,$itemId)
    {
        $base= new Base();
        $sql = "UPDATE items SET bestand = :bestand WHERE id = :itemId";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue('bestand', $bestand);
        $stmt->bindValue('itemId', $itemId);
        $stmt->execute();
    }

    //Anzahl der gewunschten Artikel im Warenkorb werden angepasst. Aendern der Tabelle cart in der Datenbank
    public function updateQuantity($menge,$itemId,$userId)
    {
        $base= new Base();
        $sql = "UPDATE cart SET menge =:menge WHERE item_id = :i_id AND user_id = :u_id";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue('menge', $menge);
        $stmt->bindValue('i_id', $itemId);
        $stmt->bindValue('u_id', $userId);
        $stmt->execute();

    }

    //Artikel wird aus dem Warenkorb entfernt. Bestand in der Artikeltabelle wieder anpassen
    public function reStockItem($itemId)
    {
        $base= new Base();
        $sql = "UPDATE items JOIN cart ON items.id = cart.item_id
                SET items.bestand = items.bestand + cart.menge
                WHERE user_id=:uid AND item_id = :item_id";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':uid', $_SESSION['userId']);
        $stmt->bindValue(':item_id', $itemId);
        $stmt->execute();
    }

    //Artikel aus dem Warenkorb entfernen
    public function removeItemFromCart($itemId,$userId)
    {
        $base= new Base();
        $sql = "DELETE FROM cart WHERE user_id=:userId AND item_id = :item_id";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':userId', $_SESSION['userId']);
        $stmt->bindValue(':item_id', $itemId);
        $stmt->execute();
    }

    //Usersession beendet: Warenkorb leeren
    public function deleteSessionCart($userId):void
    {
        $base= new Base();
        $sql = "DELETE FROM cart WHERE user_id=:userId";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':userId', $_SESSION['userId']);
        $stmt->execute();
    }
}