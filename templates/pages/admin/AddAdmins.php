<div class="container">
	<div class="row d-flex justify-content-center">
	<div class="mt-3 col-12 text-center border bg-light"><h4>Administrator hinzufuegen</h4></div>

<form  method="POST" class="col-md-6 col-sm-12 col-lg-6 mt-4 mb-4" enctype="multipart/form-data">
	
	<div class=" h-25 m-1 input-group d-flex align-items-center">
		<h5 class="col-md-12 col-xs-12 col-lg-12"> <?php echo $langArray[$opt]['PlatzhalterVorname']?>: &nbsp; </h5>
		<?php
		echo "<input class=\"col-md-12 col-xs-12 col-lg-12 form-control\" type=\"text\"  name=\"vorname\" >";
		?>
	</div>
	
	<div class=" h-25 m-1 input-group d-flex align-items-center">
		<h5 class="col-md-12 col-xs-12 col-lg-12"><?php echo $langArray[$opt]['PlatzhalterNname'];?>: &nbsp; </h5>
		<?php
		echo "<input class=\"form-control col-md-12 col-xs-12 col-lg-12\" type=\"text\"  name=\"nachname\" >";
		?>
	</div>
	
	<div class=" mt-2 input-group input-group-lg mr-sm-2">
		<h5 class="col-md-12 col-xs-12 col-lg-12"> <?php echo $langArray[$opt]['PlatzhalterPw']?>: &nbsp; </h5>
		<?php
		echo "<input class=\"form-control\" type=\"password\"  name=\"password1\" placeholder=".$langArray[$opt]['PlatzhalterPw'].">";
		?>
	</div>

	<div class="mt-2 input-group input-group-lg mr-sm-2">
		<h5 class="col-md-12 col-xs-12 col-lg-12"> <?php echo $langArray[$opt]['PlatzhalterPwRepeat']?>: &nbsp; </h5>
      	 <?php
		echo "<input class=\"form-control\" type=\"password\"  name=\"password2\" placeholder=".$langArray[$opt]['PlatzhalterPw'].">";
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