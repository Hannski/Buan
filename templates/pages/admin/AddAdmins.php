<div class="container">
	<div class="row d-flex justify-content-center">
	<div class="mt-3 col-12 text-center border bg-light"><h4><?php echo $langArray[$opt]['createA'] ?></h4></div>

<form  method="POST" class="col-md-6 col-sm-12 col-lg-6 mt-4 mb-4" enctype="multipart/form-data">
	
	<div class=" h-25 m-1 input-group d-flex align-items-center">
		<h5 class="col-md-12 col-xs-12 col-lg-12"> <?php echo $langArray[$opt]['vorname']?>: &nbsp; </h5>
		<?php
		echo "<input class=\"col-md-12 col-xs-12 col-lg-12 form-control\" type=\"text\"  name=\"vorname\" placeholder=".$langArray[$opt]['vorname'].">";
		?>
	</div>
	
	<div class=" h-25 m-1 input-group d-flex align-items-center">
		<h5 class="col-md-12 col-xs-12 col-lg-12"><?php echo $langArray[$opt]['nachname'];?>: &nbsp; </h5>
		<?php
		echo "<input class=\"form-control col-md-12 col-xs-12 col-lg-12\" type=\"text\"  name=\"nachname\" placeholder=".$langArray[$opt]['nachname']." >";
		?>
	</div>
	
	<div class=" mt-2 input-group input-group-lg mr-sm-2">
		<h5 class="col-md-12 col-xs-12 col-lg-12"> <?php echo $langArray[$opt]['Pw']?>: &nbsp; </h5>
		<?php
		echo "<input class=\"form-control\" type=\"password\"  name=\"password1\" placeholder=".$langArray[$opt]['Pw'].">";
		?>
	</div>

	<div class="mt-2 input-group input-group-lg mr-sm-2">
		<h5 class="col-md-12 col-xs-12 col-lg-12"> <?php echo $langArray[$opt]['PwRepeat']?>: &nbsp; </h5>
      	 <?php
		echo "<input class=\"form-control\" type=\"password\"  name=\"passwortMatch\" placeholder=".$langArray[$opt]['PwRepeat'].">";
		?>
		
	</div>
	<div class="mt-2  p-4">
	<button type="submit " class=" m-2 btn bnt-lg btn-outline-success my-2 my-sm-0" name="addAdmin">
		<?php echo $langArray[$opt]["addAdmin"]?>
			
	</button></div>
	


</form>
</div>
</div>
	
</div>