<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 03.01.2020
 * Time: 13:00
 */

namespace Model\Resource;
use Model\BestellverwaltungMdl as BestellverwaltungModel;

class Bestellverwaltung extends Base
{

//bestellung hinzufuegen
    public function insertOrder($userId)
    {

        $base = new Base();
        $sql = "INSERT INTO bestellverwaltung (datum) VALUES (CURRENT_DATE()) ";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue('user_id', $userId);
        //id des eingegebenen eintrags zurueckgeben.
        $stmt->execute();
        return $connection->lastInsertId();
    }





}