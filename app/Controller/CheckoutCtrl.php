<?php
/*
 * Wilkommen im Checkout-Controller. Hier werden alle Anfragen bezueglich des Warenkorbs verarbeitet.
 * Anhand der url, lassen sich die verschiedenen Methoden dieses Controllers aufrufen.
 * Jede Funktion in diesem Controller startet daher mit einer Abfrage, ob der Zugriff genehmigt- oder umgeleitet wird
 * auf eine "kein Zugriff"- Seite.
 * */
namespace Controller;

use Model\Resource\AdressMdl;
use Model\Resource\BestellungenMdl;
use Model\Resource\Bestellverwaltung;
use \Model\Resource\CheckoutMdl;
use \Model\Resource\ProduktMdl;
use Model\Resource\UserMdl;


class CheckoutCtrl extends AbstractCtrl
{

    protected $bestelldifferenz;
    protected $bestandNeu;

    //Produkte in den Warenkorb hinzufuegen oder aktualisieren-Funktion
    //wird im UserController-> homeAction() aufgerufen
    public function addToCart()
    {
        //Resourcemodel: Produkt
        $p_resource = new ProduktMdl();
        //Resourcemodel: Warenkorb
        $c_resource = new CheckoutMdl();
        //Formular auswerten

        if ($this->isPost('toCart'))
        {   $menge = $_POST['quan'];
            $item_id = $_POST['id'];
            //Produktbestand aus Datenbank holen
            $produkt = $p_resource->getProduktById($item_id);
            $vorrat = $produkt->getMenge();

            //Wenn Menge groesser Vorrat: Fehler
            if ($menge > $vorrat) {
                //Fehler ausgeben
                require './language/lang.php';
                echo $langArray[$_SESSION['language']]['tooMuch'];
            }
            //mengenangabe mindestens 1, sonst Fehler
            elseif($menge < 1)
            {
                //Fehler ausgeben
                require './language/lang.php';
                echo $langArray[$_SESSION['language']]['tooLittle'];
            }
            //keine Fehler. Ist der artikel schon im Warenkorb? ja:
           elseif($c_resource->itemInCart($item_id))
            {
                //aktualisieren der Menge des Produktes im Warenkorb
                 $c_resource->updateCart($menge, $item_id);
                //neuen Bestand berrechnen + update ArtikelVorrat in Produktetabelle
                $updateVorrat = $vorrat - $menge;
                //Aktualisiere  bestand  set bestand = vorratWertNeu bei $item_id,
                $p_resource->updateProdukt($item_id, 'bestand', $updateVorrat);
            } else {
                //Ist der Artikel noch nicht im Warenkorb
                //Artikel in den Warenkorb einfuegen
                $c_resource->insertCart($menge, $item_id);
                //neuen Bestand berrechnen + update ArtikelVorrat in Produktetabelle
                $updateVorrat = $vorrat - $menge;
                //Aktualisiere  bestand  set bestand = vorratWertNeu bei $item_id,
                $p_resource->updateProdukt($item_id, 'bestand', $updateVorrat);
            }
        }
    }



    //Wenn eine Bestellung abgeschickt wurde, erscheint diese Ansicht, um eine Bestellungsbestaetigung anzuzeigen.
    //Ausserdem passt die Funktion in der Datenbank Verhaeltnisse an.
    public function bestellungAction()
    {
        //nur angemeldete nutzer duerfen hier her.
        $this->userOnly();

        //Wurde Bestellung abgeschickt? ja:
        if ($this->isPost('placeOrder')) {
            //OrderIdResourceModel
            $order = new Bestellverwaltung();

            //Last insert Id=OrderId
            $orderId= $order->insertOrder($_SESSION['userId']);

            //BestellResourceModel
            $resource = new BestellungenMdl();

            //Bestellung in die Datenbank
            $resource->placeOrder($orderId);

            //Anzeige
            $this->getNav();

            //nachricht:
            $errorArray[] = 'orderYes';
            echo $this->render('seitenkomponenten/errors', array('errorArray'=>$errorArray));
        }

    }


    //gewuenschte Anzahl eines Produktes im Warenkorb anpassen. Datenbank anpassen.
    public function updateQuan($gewuenschteNeueMenge, $reservierteMenge ,$itemId)
    {
        //wie ist der ArtikelBestand in der Datenbank?
        $resourceItem = new ProduktMdl();
        $produkt = $resourceItem->getProduktById($itemId);
        $bestand =$produkt->getMenge();

        //resourceModel
        $resource= new CheckoutMdl();
        //Usre hat eingabe bestaetigt ohne sie auszufuellen
        if ($gewuenschteNeueMenge=="")
        {
            return;
        }
        //user hat 0 eingegeben um Produkt aus Warenkorb los zu werden
        elseif($gewuenschteNeueMenge==0)
        {
            $this->removeFromCart($itemId);
        }
        else
        {
            //Differenz berrechnen
            //gewuenschte neue menge groesser doer gleich der bereits aus dem bestand reservierten Menge
            if( $gewuenschteNeueMenge >= $reservierteMenge)
            {
                //differenz berrechnen
                $this->bestelldifferenz = $gewuenschteNeueMenge - $reservierteMenge;
                $this->bestandNeu = $bestand - $this->bestelldifferenz ;
                //geht die gewuenschte bestandaenderung unter das Null limit?
                if ( $this->bestandNeu <0)
                {
                    //Fehler Ausgeben:
                    $errorArray[]='tooMuch';
                    return $this->renderErrors($errorArray);

                }else{

                    //anpassen der Menge im Warenkorb
                    $resource->updateQuantity($gewuenschteNeueMenge,$itemId,$_SESSION['userId']);
                    //Produktbestand anpassen in der Datenbank
                    $resource->editStock($this->bestandNeu,$itemId);
                    //Erfolg: Nachricht
                    $errorArray[]='changeSuccess';
                    return $this->renderErrors($errorArray);
                }
            }
            //Eingabe kleiner der original gewuenschten artikelmenge
            else
            {
                $this->bestelldifferenz = $reservierteMenge - $gewuenschteNeueMenge;
                $this->bestandNeu = $bestand + $this->bestelldifferenz;
                //anpassen der Menge im Warenkorb
                $resource->updateQuantity($gewuenschteNeueMenge,$itemId,$_SESSION['userId']);
                $resource->editStock($this->bestandNeu,$itemId);
                //Erfolg: Nachricht
                $errorArray[]='changeSuccess';
                return $this->renderErrors($errorArray);
            }
        }
    }


    // Produkt aus dem Warenkorb entfernen, wenn user "0" als gewuenschte anzahl angibt, oder einen button betaetigt
    //Bestand der Artikel wieder anpassen
    public function removeFromCart($itemId)
    {
        //resource-Model
        $resource = new CheckoutMdl();

        //Artikelbestand wir per sql anpassen
        $resource->reStockItem($itemId);

        //dem Nutzer zugerodnetes Cart-item loeschen.
        $resource->removeItemFromCart($itemId,$_SESSION['userId']);

    }


    //Anzeige Warenkorb: Uebersicht ueber alle Artikel und Lieferdetails (Lieferadresse, Gesamtsumme, Zahloptionen)
    //alleinige Zahloption: 'auf Rechnung'
    //Template:'pages/cart/warenkorb'
    public function warenkorbAction()
    {
        //nur angemeldete nutzer duerfen hier her.
        $this->userOnly();
        $this->getNav();
        if($this->isPost('updateQuan')){echo $this->updateQuan($_POST['quan'],$_POST['menge'],$_POST['id']); }
        if($this->isPost('unselectItem')){$this->removeFromCart($_POST['id']);}
        //Anzeige

        //Resourcemodels
        $user = new UserMdl();
        $cart = new CheckoutMdl();
        $adress = new AdressMdl();

        //gibt es zu diesem user schon einen Warenkorb?
        if ($cart->isCart($_SESSION['userId'])) {
            //ja? bitte aus der Datenbank holen
            $cartArray = $cart->getCart();

            /*adresslogik wird in Template verarbeitet: wenn adressArray leer:meldung sonst Anzeige und aendern option = direkt moeglichkeit
            eine Betslelung zu tateigen
            */
            if ($adress->isAddress($_SESSION['userId'])) {
                //user hat bereits eine Adress eingegeben: Warenkorb mit Adressvorschau
                $adressArray = $user->getUserAdress($_SESSION['userId']);
                echo $this->render('pages/cart/warenkorb', array('cartArray' => $cartArray), array('adressArray' => $adressArray));
            }
            else{
                //Noch keine Adresse:
                $adressArray=array();
                echo $this->render('pages/cart/warenkorb', array('cartArray' => $cartArray), array('adressArray' => $adressArray));
            }
        } else{

            //User hat noch nichts im Warenkorb: Meldung
            $errorArray[]="emptyCart";
            echo $this->render('seitenkomponenten/errors',array('errorArray'=>$errorArray));
        }
    }
}