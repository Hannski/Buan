<!-- Seiteninhalt, produktanzeige -->
	<div class="container p-4">
		<div class="row">
	<?php
	//  Englische Inhalte, wenn Englisch ausgewaehlt (session "0" = deutsch, 1 = englisch)
	//Fehler abfangen, falls Sprache noch nicht gewählt
	//(wird über styleswitch geregelt)
	//Fehler abfangen : $lang =(isset($_SESSION['language']) == true ? $_SESSION['language'] = $_SESSION['language'] : $_SESSION['language'] = 0 );
	$lang = $_SESSION['language'];
	//echo $lang;
	foreach ($produkteArray as $key)
	 {

	 	 	$id =       $key->getId();
	 	 	$pDname = $key->getNameDe();
			$pEname = $key->getNameEn();
			$desD = $key->getBeschreibungDe();
			$desE = $key->getBeschreibungEn();
			$preis = $key->getPreis();
			$file = $key->getDateiname();
		 ?>
	<div class="col-sm-12 col-md-12 col-lg-4">
    <div class="card bg-light mb-4" >	
    <img  class="card-img-top" src="Assets/<?php echo $file; ?>" alt="<?php echo $file ?>">	
      <div class="card-body">
      	<?php /* Wenn sprache= Englisch, gib Englsiche Info, sonst Deutsch*/ ?>
        <h5 class="card-title"><?php echo $out = ($lang == 1 ?  $pEname :  $pDname)?></h5>
        <p class="card-text"><?php echo $out = ($lang == 1 ?  $desE :  $desD)?></p>
        <p class="card-text"><b><?php echo $preis ?> €</b></p>
         <p> <form action="" method="POST">
        	<label for="quan">Menge:</label><br>
        	<input type="number" name="quan">
        	<input type="hidden"  name="id" value ="<?php echo $id ?>">
        	<button type="submit" class="btn btn-danger" name = "to_cart">in den Warenkorb</button>
           </form>
    	</p>	
      </div>
    </div>
  </div>
<?php
}
?>
	 </div>
	 </div>


	
