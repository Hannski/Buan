	<?php
/*
Template: Administratoren bearbeiten, wird nur dem Superadmin als Option gegeben. Regulre Administratoren duerfen Admindaten, mit Ausnahme der eigenen Daten, nicht bearbeiten
-jeweils eine Karte für einen Admin wird gelistet. per GET- bei absenden des formulars, wird das einzelne, zu bearbeitende Eintrag als Einzelansicht aufgerufen
-Angezeigt werden alle Administratoren ausser der Superadmin
-Superadmin besitzt als einziger die Rechte, neue Administratoren zu erstellen und zu bearbeiten.
*/
 ?>

<div class="container mt-3">
	<div class="row p-4">
		
			<?php
			foreach ($adminArray as $key){
			$id = $key->getAId();
	 		$vorname = $key->getAVorname();
			$nachname = $key->getANname();
			$status = $key->getStatus();
			?>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
	<div class="card bg-light mb-4" >	
    <div class="card-body text-left">
        <p><?php  echo $langArray[$opt]['vorname']?>  <b><?php echo $vorname  ?></b></p>
        <p><?php  echo $langArray[$opt]['nachname']?>  <b><?php echo $nachname ?></b></p>
        <p><?php  echo $langArray[$opt]['status']?>:&nbsp;
            <b><?php echo $status==0 ?  $langArray[$opt]['active'] : $langArray[$opt]['blocked']?></b>
        </p>
    <p class="p-4"> <form action="admin-verwalten/" class="text-center" method="GET">
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
	