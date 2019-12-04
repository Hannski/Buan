<?php
namespace Model\Resource;
use Model\CartMdl as CartModel;
class CartMdl extends Base
{
public function insertCart($cart)
{
	$base= new Base();
    $sql = "INSERT INTO cart(item_id,menge) VALUES (:id,:menge)";
    $connection = $base->connect();
    $stmt = $connection->prepare($sql);
    // Fehler Abfangen var_dump($cart);
    $items =array();
    
    $stmt->bindValue('id',$cart->getProduktId());
    $stmt->bindValue('menge',$cart->getMenge());
    $stmt->execute();
}

// public function getCart()
// {
// 	("SELECT * FROM cart WHERE id="$id"");
// }
}