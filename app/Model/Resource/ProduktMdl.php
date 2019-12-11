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
        dateiname,
        bestand
        ) 
        VALUES(
        :name_de,
        :name_en,
        :beschreibung_de,
        :beschreibung_en,
        :preis,
        :dateiname,
        :bestand
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
        $stmt->bindValue('bestand',         $produkt->getMenge());
        $stmt->execute();
        

 }

/*Alle Produktinformationen aus der Datenbank wo Lagerbestände positiv sind und nicht gesperrt*/
 public function getAllProducts()
 {
        $base= new Base();
        //Nur Produkte, die auf Lager sind anzeigen. 
        $sql = "SELECT id,name_de,name_en,beschreibung_de,beschreibung_en,preis,dateiname  FROM items WHERE bestand > 0 AND gesperrt = 0";
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

 //Alle Produkte, Egal welche Bestände und Sperrstatus
 public function getAllAdminProducts()
 {
    $base= new Base();
        //Nur Produkte, die auf Lager sind anzeigen. 
        $sql = "SELECT id,name_de,name_en,beschreibung_de,beschreibung_en,preis,dateiname,bestand,gesperrt  FROM items ";
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
            $product->setMenge($row['bestand']);
           //Verständnis für Admin verbessern. statt 0 und 1 : sichtbar oder gesperrt
            if($row['gesperrt']== NULL){
                 $product->setStatus("sichtbar");
            }else{
            $product->setStatus("gesperrt");
            }
            //Ins array schreiben
            $productArray[] = $product;
        }
        return $productArray;

 }

 //Produkt nach ID
 public function getProduktById($id)
 {
            $base = new Base();
            $sql = ("SELECT * FROM items WHERE id=$id");
            $dbResult = $base->connect()->query($sql);
            while ($row = $dbResult->fetch(\PDO::FETCH_ASSOC))
        {
            $produktArray = array();
            $product = new ProduktModel();
            $product->setId($row['id']);
            $product->setNameDe($row['name_de']);
            $product->setNameEn($row['name_en']);
            $product->setBeschreibungDe($row['beschreibung_de']);
            $product->setBeschreibungEn($row['beschreibung_en']);
            $product->setPreis($row['preis']);
            $product->setDateiname($row['dateiname']);
            $product->setMenge($row['bestand']);
             if($row['gesperrt']==0){
                 $product->setStatus("sichtbar");
            }else{
            $product->setStatus("gesperrt");
            }
           
            //Ins array schreiben
            $produktArray[] = $product;
        }
            return $produktArray;
 }

 //Produktinformationen aktualisieren
 public function UpdateProdukt($id,$edit,$value)
 {
        $base= new Base();
        $sql ="UPDATE items SET $edit = ? WHERE id = ?";
        $connection = $base->connect();
        $stmt = $connection->prepare($sql);
        $stmt->execute([$edit=$value,$id]);        
 }

}

