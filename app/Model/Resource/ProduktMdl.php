<?php
namespace Model\Resource;
use Model\ProduktMdl as ProduktModel;
class ProduktMdl extends Base
{

//Produktinformationen in Datenbank schreiben
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

//Alle Produktinformationen aus der Datenbank
 public function getAllProducts()
 {
        $base= new Base();
        $sql = "SELECT id,name_de,name_en,beschreibung_de,beschreibung_en,preis,dateiname FROM items";
        $dbResult = $base->connect()->query($sql);
        $productArray = array();
        while ($row = $dbResult->fetch(\PDO::FETCH_ASSOC))
        {
            //Instanzierung der Klasse Produkt in Model/Produkt.php (setters und Getters)
            $product = new ProduktModel();
            $product->setId($row['id']);
            $product->setNameDe($row['name_de']);
            $product->setNameEn($row['name_en']);
            $product->setBeschreibungDe($row['beschreibung_de']);
            $product->setBeschreibungEn($row['beschreibung_en']);
            $product->setPreis($row['preis']);
            $product->setDateiname($row['dateiname']);
            //Ins array schreiben
            $productArray[] = $product;
        }
        return $productArray;
 }

}

