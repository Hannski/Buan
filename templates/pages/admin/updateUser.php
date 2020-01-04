
<div class="container mt-3 h-100">
	<div class="row">
			<?php
			foreach ($userArray as $key){

	 	 	$username = $key->getUsername();
			$status = $key ->getStatus();
			?>
	<div class="card col-12 p-0">
    <div class="card-header">
        <h6>Daten fuer den user "<?php echo $username ?>" aendern</h6>
    </div>


        <form action="" method="POST">
    <div class="card-body d-flex flex-column align-items-center">
         <!--Username -->
    <div class="form-group">
        <label for="username" >Username:&nbsp;<b><?php echo $username ?></b></label>

         <input class="form-control" type="text" id="username" name="name_de">

    </div>
 <!-- Name Englisch -->
        <div class="form-group"><label for="status">Status:</label></div>
        <div class="form-group">
   <div class="form-check ">
       <label class="form-check-label" for="status1" >aktiv</label>
                 <input class="form-check-inline" type="radio" name="name_en" id="status1" value="0" selected>
    </div>
        <div class="form-check ">
       <label class="form-check-label" for="status2">sperren</label>
                 <input class="form-check-inline" type="radio" name="name_en" id="status2" value="1">
        </div>
        </div>

        <div class="form-group"> <button type="submit" name="aendern" class="btn btn-sm btn-submit border" value="name_en">
                <?php echo $langArray[$opt]["aendern"] ?>
            </button></div>
    </div>
        </form>
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