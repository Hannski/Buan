<?php
/*Template: User Bearbeiten: jeweils eine Karte für einen User wird gelistet. per GET- bei absenden des formulars, wird der einzelne, zu bearbeitende User als Einzelansicht aufgerufen*/
 ?>
<div class="container mt-4">
	<div class="row p-4">
		
			<?php
			foreach ($userArray as $user){
			$id=$user->getId();
            $username=$user->getUsername();
            $datum=$user->getAcceptiondate();
            $status=$user->getStatus();
			?>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
	<div class="card bg-light mb-4" >	
    <div class="card-body text-left">
        <p>Name Deutsch:&nbsp;				<b><?php echo $id ?></b></p>
        <p>Name Englisch:&nbsp; 			<b><?php echo $username ?></b></p>
        <p>Beschreibung Englisch:&nbsp; 	<b><?php echo $status ?></b></p>

        <?php
        $date = new DateTime($datum);
		echo $date->format('d.m.Y');
 		 ?>

        <p>Beschreibung Deutsch:&nbsp; 		<b><?php  ?></b></p>
        <p> 
    <p class="p-4"> <form action="user-bearbeiten/" class="text-center" method="GET">
    <input type="hidden"  name="id" value ="<?php echo $id ?>">
    <button type="submit" class="btn btn-danger">Bearbeiten</button>
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