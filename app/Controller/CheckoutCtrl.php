<?php
namespace Controller;
use Model\Resource\BestellungenMdl;
use \Model\Resource\CheckoutMdl;
use \Model\Resource\ProduktMdl;
use \Form\UserAdressForm;
use Model\Resource\UserMdl;

class CheckoutCtrl extends AbstractController
{	
	public function addToCart()
    {
    $p_resource = new ProduktMdl();
    $c_resource = new CheckoutMdl();
       if (!empty($_POST["quan"]) && $_POST['quan'] > 0) {
           $menge = $_POST['quan'];
        $item_id = $_POST['id'];
        //Produkt nach Id aus Datenbank:

        $p = $p_resource->getProduktById($item_id);

        foreach ($p as $key) {
            $vorrat = $key->getMenge();
        }

        //Wenn Menge groeßer Vorrat: Fehler
        if ($menge > $vorrat) {
            echo 'error zu viele Artikel';
        } else {

            //true = schon in db
            if ($c_resource->itemInCart($item_id))
            {

                $c_resource->updateCart($menge,$item_id);
            }
            else{
               //ab in die db
               $this->insertCart();
            }
            //neuen bestand berrechnen + update in Db
            $updateVorrat = $vorrat - $_POST['quan'];
            $p_resource->updateProdukt($item_id, 'bestand', $updateVorrat);
        }

    }

    }
    //Eingabe Adresse
    public function adressdatenAction()
    {
        if ($this->isPost('adress'))
        {

            $form = new UserAdressForm();
            $errorArray = $form->getErrorList();
            if (!empty($errorArray)) {
                echo $this->render('seitenkomponenten/errors', array('errorArray' => $errorArray));
            } else {
                $resource = new UserMdl();
                $resource->insertUserAdress($_POST['strasse'], $_POST['nummer'], $_POST['plz'], $_POST['ort'], $_POST['land']);
                header("refresh:0");
            }
        }
        $this->getNav();
        $resource = new UserMdl();
       if($resource->isUserAdress($_SESSION['userId']))
       {
           $adressArray = $resource->getUserAdress($_SESSION['userId']);
           echo $this->render('pages/user/adressForm',array('adressArray' => $adressArray));
       }
       else{

           echo $this->render('pages/user/adressForm');
       }

    }







    public function bestellungAction()
    {
        if ($this->isPost('submitOrder'))
        {
            $resource = new BestellungenMdl();
            $resource->placeOrder();

        }
        $this->getNav();
        echo $this->render('pages/bestellungen/b_erfolg',array());
    }

	public function insertCart()
    {
        $resource = new CheckoutMdl();
        $resource->getCart();
        $id = $_POST['id'];
        $quan = $_POST['quan'];

        if (!empty($_POST["quan"]) && $_POST['quan'] > 0) {
            $menge = $_POST['quan'];
            $id = $_POST['id'];
            //Produkt nach Id aus Datenbank:
            $resource = new ProduktMdl();
            $p = $resource->getProduktById($id);

            foreach ($p as $key) {
                $vorrat = $key->getMenge();
            }

            //Wenn Menge groeßer Vorrat: Fehler
            if ($_POST['quan'] > $vorrat) {
                echo 'error zu viele Artikel';
            } else {
                //neuen bestand berrechnen + update in Db
                $updateVorrat = $vorrat - $_POST['quan'];
                $resource = new ProduktMdl();
                $resource->updateProdukt($_POST['id'], 'bestand', $updateVorrat);
            }
            //Produkt in den Warenkorb
            $cartItem = new \Model\CheckoutMdl();
            $cartItem->setProduktId($id);
            $cartItem->setMenge($menge);
            $Cart = new CheckoutMdl();
            $Cart->insertCart($cartItem);
        }
    }


public function warenkorbAction()
{
    $this->getNav();
    $user = new UserMdl();
    $cart = new CheckoutMdl();
    if ($cart->isCart($_SESSION['userId']))
    {
        $cartArray = $cart->getCart();
        if($user->isUserAdress($_SESSION['userId']))
        {
            //user hat bereits iene Adress eingegeben: Warenkorb mit Adressvorschau
            $adressArray = $user->getUserAdress($_SESSION['userId']);
            echo $this->render('pages/cart/warenkorb',array('cartArray'=>$cartArray),array('adressArray'=>$adressArray));
        }
        else{
            //USer hat noch keine Adresse eingegeben: warenkorb mit Adresseingabe
            echo $this->render('pages/cart/warenkorb',array('cartArray'=>$cartArray));
        }
    }else
        {
        echo "noch keine Artikel im Warenkorb";
    }




}


	
}