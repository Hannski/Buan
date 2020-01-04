<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 03.01.2020
 * Time: 13:00
 */

namespace Model\Resource;


class Bestellverwaltung extends Base
{

//bestellung hinzufuegen
    public function insertOrder($userId)
    {
        $base=new Base();
        $base = new Base();
        $sql = "INSERT INTO bestellverwaltung (user_id) VALUES (:user_id) ";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue('user_id', $userId);
        //id des eingegebenen eintrags zurueckgeben.
        $stmt->execute();
        return $connection->lastInsertId();
    }

}