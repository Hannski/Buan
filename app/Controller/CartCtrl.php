<?php
namespace Controller;
use \Model\Resource\CartMdl;
use \Model\Resource\ProduktMdl;
use App;
class CartCtrl
{	
	public function addToCart()
	{
		 
			$id = $_POST['id'];
			$quan = $_POST['quan'];

	if(!empty($_POST["quan"]) && $_POST['quan']>0)
	{
		$menge = $_POST['quan'];
		$id =$_POST['id'];
		//Produkt nach Id aus Datenbank:
		$p = ProduktMdl::getProduktById($id);
		foreach ($p as $key ) {
		 $vorrat = $key->getMenge();
		}
		//Wenn Menge großer Vorrat: Fehler
		//Produkt in den Warenkorb
		$cartItem = App::getModel('CartMdl');
		$cartItem->setProduktId($id);
		$cartItem->setMenge($menge);
		$Cart = App::getResourceModel('CartMdl');
		$Cart->insertCart($cartItem);		
	}
}


	
}