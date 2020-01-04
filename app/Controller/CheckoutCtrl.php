<?php

namespace Controller;

use Model\Resource\AdressMdl;
use Model\Resource\BestellungenMdl;
use Model\Resource\Bestellverwaltung;
use \Model\Resource\CheckoutMdl;
use \Model\Resource\ProduktMdl;
use \Form\UserAdressForm;
use Model\Resource\UserMdl;

//Controller regelt ablaeufe in Zusammenhang mit Warenkorb

class CheckoutCtrl extends AbstractController
{

    //Produkte in den Warenkorb hinzufuegen oder aktualisieren
    public function addToCart()
    {
        //ProduktModel
        $p_resource = new ProduktMdl();
        //WarenkorbModel
        $c_resource = new CheckoutMdl();
        //keine Nutzereingabe oder Eingabe negativ/ = 0
        if (!empty($_POST['quan']) && $_POST['quan'] > 0)
        {
            $menge = $_POST['quan'];
            $item_id = $_POST['id'];
            //Produktbestand aus DB.
            $p = $p_resource->getProduktById($item_id);
            foreach ($p as $key) {
                $vorrat = $key->getMenge();
            }

            //Wenn Menge groesser Vorrat: Fehler
            if ($menge > $vorrat) {
                //fehler
                echo 'error zu viele Artikel';
            }
            //ist der artikel schon im Warenkorb?
           if($c_resource->itemInCart($item_id))
            {
                //aktualisieren der Menge des Produktes im Warenkorb
                 $c_resource->updateCart($menge, $item_id);
            } else {
                    //den Artikel neu hinzufuegen
               //Produkt in den Warenkorb

                    $c_resource->insertCart($menge,$item_id);
                }

                //neuen Bestand berrechnen + update ArtikelVorrat in Produktetabelle
                $updateVorrat = $vorrat - $menge;
                //Aktualisiere  bestand  set bestand = vorratWertNeu bei $item_id,
                $p_resource->updateProdukt($item_id, 'bestand', $updateVorrat);
        }
    }




/*
 * Bestellung abschicken wenn:
 *
 * */
    public function bestellungAction()
    {
/**/
        //POst verarbeiten
        if ($this->isPost('placeOrder')) {
            //OrderIdentityModel
            $order = new Bestellverwaltung();
            //Last insert ID
            $orderId= $order->insertOrder($_SESSION['userId']);
            //BestellModel
            $resource = new BestellungenMdl();
          //Bestellung in Db
           $resource->placeOrder($orderId);
            //Anzeige
            $this->getNav();
            //nachricht:
            $errorArray[] = 'orderYes';
            echo $this->render('seitenkomponenten/errors', array('errorArray'=>$errorArray));
        }
        else{
            //TODO::pfad definieren wo man landet wenn man hier nichts zu suchen hat
            header('Location: ./');

        }


    }


    //Anzeige Warenkorb
    public function warenkorbAction()
    {
        $this->getNav();
        $user = new UserMdl();
        $cart = new CheckoutMdl();
        $adress = new AdressMdl();
        //gibt es zu diesem user schon einen Warenkorb?
        if ($cart->isCart($_SESSION['userId'])) {
            //ja? bitte holen
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
            //USer hat noch nichts im Warenkorb: Meldung
            $errorArray[]="emptyCart";
            echo $this->render('seitenkomponenten/errors',array('errorArray'=>$errorArray));
        }


    }


}