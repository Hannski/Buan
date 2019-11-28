<?php
namespace Model\Resource;
use Model\ProduktMdl as ProduktModel;
class ProduktMdl extends Base
{
 public function insertProdukt( $produkt)
 {
 		$base= new Base();
        $sql = "INSERT INTO items(      
        name_de,
        name_en,
        beschreibung_de,
        beschreibung_en,
        preis,
        dateiname
        ) 
        VALUES(
        :name_de,
        :name_en,
        :beschreibung_de,
        :beschreibung_en,
        :preis,
        :dateiname
    	)";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        //Werte zuweisen
        $stmt->bindValue('name_de', 		$produkt->getNameDe());
        $stmt->bindValue('name_en', 		$produkt->getNameEn());
        $stmt->bindValue('beschreibung_de', $produkt->getBeschreibungDe());
        $stmt->bindValue('beschreibung_en', $produkt->getBeschreibungEn());
        $stmt->bindValue('preis', 			$produkt->getPreis()); 
        $stmt->bindValue('dateiname',		$produkt->getDateiname());
        $stmt->execute();
        

 }
}

