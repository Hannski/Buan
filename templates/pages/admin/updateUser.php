
<div class="container mt-3 h-100">
	<div class="row">
			<?php
			foreach ($userArray as $key){

	 	 	$username = $key->getUsername();
			$status = $key ->getStatus();
			?>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

 
   
    <div class="card-body  text-center">
 
         <!--Username -->
    <div class="border-bottom mb-4 p-4">
        <div class="mb-3">Username:&nbsp;<b><?php echo $username ?></b></div>
        <form action="" method="POST">
         <input type="text" name="name_de">
            
            <button type="submit" name="aendern" class="btn btn-sm btn-submit border" value="name_de">
            <?php echo $langArray[$opt]["aendern"] ?>
            </button>

        </form>
    </div>
 <!-- Name Englisch -->
   <div class="border-bottom mb-4 p-4">
        <div class="mb-3">Status: &nbsp;<b><?php echo $langArray[$opt][$status] ?></div>
        <form action="" method="POST">

         <input type="text" name="name_en">
            <button type="submit" name="aendern" class="btn btn-sm btn-submit border" value="name_en">
            <?php echo $langArray[$opt]["aendern"] ?>
            </button>

        </form>
    </div>


    
	
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