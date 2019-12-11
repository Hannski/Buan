<?php
/*Template: Produkte Bearbeiten: jeweils eine Karte für ein Produkt wird gelistet. per GET- bei absenden des formulars, wird das einzelne, zu bearbeitende Produkt als Einzelansicht aufgerufen*/
 ?>
<div class="container mt-3">
	<div class="row p-4">
		
			<?php
			foreach ($produkteArray as $key){
			$id = $key->getId();
	 	 	$pDname = $key->getNameDe();
			$pEname = $key->getNameEn();
			$desD = $key->getBeschreibungDe();
			$desE = $key->getBeschreibungEn();
			$preis = $key->getPreis();
			$file = $key->getDateiname();
			$lager = $key->getMenge();
			$status = $key->getStatus();
			?>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
	<div class="card bg-light mb-4" >	
    <img  class="card-img-top" src="Assets/<?php echo $file; ?>" alt="<?php echo $file ?>">	
    <div class="card-body text-left">
        <p>Name Deutsch:&nbsp;				<b><?php echo $pDname ?></b></p>
        <p>Name Englisch:&nbsp; 			<b><?php echo $pEname ?></b></p>
        <p>Beschreibung Englisch:&nbsp; 	<b><?php echo $desE ?></b></p>
        <p>Beschreibung Deutsch:&nbsp; 		<b><?php echo $desD ?></b></p>
        <p>Preis: &nbsp;					<b><?php echo $preis ?></b></p>
        <p>Lagerbestand:&nbsp; 				<b><?php echo $lager ?></b></p>
        <p>Status:&nbsp;					<b><?php echo $status ?></b></p>
        <p> 
    <p class="p-4"> <form action="produkt-bearbeiten" class="text-center" method="GET">
    <input type="hidden"  name="id" value ="<?php echo $id ?>">
    <button type="submit" class="btn  btn-danger">Bearbeiten</button>
    </form>
    </p>	
    </div>
    </div>
	</div>
		<?php
		}
		//Ende foreach
		 ?>
<!-- Ende Row -->
	</div> 
	<!-- Ende Container -->
</div>