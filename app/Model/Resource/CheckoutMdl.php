<?php
namespace Model\Resource;
use Model\CheckoutMdl as CheckoutModel;
use Model\WarenkorbMdl;

class CheckoutMdl extends Base
{
    //hat der user bereits diesen artikel in den Korb gelegt?
    public function itemInCart($item_id)
    {
        $base = new Base();
        $sql = "SELECT * FROM cart WHERE user_id = :user_id AND item_id = :item_id ";
        $connection = $base->connect();
        $stmt= $connection->prepare($sql);
        $stmt->bindValue(':user_id',$_SESSION['userId']);
        $stmt->bindValue(':item_id',$item_id);
        $stmt->execute();
        //Ergebnis?
        while ($row =$stmt->fetch(\PDO::FETCH_ASSOC))
        {
           return true;
           echo "hi";
        }
        //item noch nicht im Warenkorb
        return false;
    }


public function insertCart($cart)
{
	$base= new Base();
    $sql = "INSERT INTO cart(item_id,user_id,menge) VALUES (:id,:userId,:menge)";
    $connection = $base->connect();
    $stmt = $connection->prepare($sql);
    // Fehler Abfangen var_dump($cart);
    $items =array();
    
    $stmt->bindValue('id',$cart->getProduktId());
    $stmt->bindValue('userId',$_SESSION['userId']);
    $stmt->bindValue('menge',$cart->getMenge());
    $stmt->execute();
}

    public function updateCart($menge,$itemId)
    {
        $base= new Base();
        $sql ="UPDATE cart SET menge = menge + ?  WHERE user_id = ? AND item_id = ?";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->execute(array($menge,$_SESSION['userId'],$itemId));


    }

    //ist der Warenkorb leer?
    public function isCart($userId):bool
    {

        $base = new Base();
        $sql = "SELECT * FROM cart WHERE user_id = :id";
        $connection = $base->connect();
        $stmt= $connection->prepare($sql);
        $stmt->bindValue(':id',$userId);
        $stmt->execute();
        $cartArray = array();
        while ($row =$stmt->fetch(\PDO::FETCH_ASSOC))
        {
            return true;
        }
        return false;
    }

    //hole Warenkorb
    public function getCart()
    {

        $base = new Base();
            $sql = "SELECT * FROM items RIGHT JOIN cart ON items.id = cart.item_id WHERE user_id = :id";
        $connection = $base->connect();
        $stmt= $connection->prepare($sql);
        $stmt->bindValue(':id',$_SESSION['userId']);
        $stmt->execute();
        $cartArray = array();
        while ($row =$stmt->fetch(\PDO::FETCH_ASSOC))
        {
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
}