<div class="container p-3">

<form method="POST" class=" row form-signin bg-light container p-4 d-flex-flex-col justify-content-center">
    <div class="col-12 p-4">
	<span><h1><?php echo $langArray[$opt]["adminSignin"]?></h1></span>
	<div class=" h-25 input-group input-group-lg mr-sm-2">
		<?php
		echo "<input class=\"form-control\" type=\"text\"  name=\"vorname\" placeholder=".$langArray[$opt]['vorname'].">";
		?>
	</div>
	<div class=" h-25 input-group input-group-lg mr-sm-2">
		<?php
		echo "<input class=\"form-control\" type=\"text\"  name=\"nachname\" placeholder=".$langArray[$opt]['nachname'].">";
		?>
	</div>

	<div class=" h-25 input-group input-group-lg mr-sm-2">
		<?php
		echo "<input class=\"form-control\" type=\"password\"  name=\"password\" placeholder=".$langArray[$opt]['Pw'].">";
		?>
	</div>
    <div class=" mr-sm-2">
	<button type="submit" class=" m-2 btn bnt-lg btn-outline-success my-2 my-sm-0" name="a_login">
		<?php echo $langArray[$opt]["loginAdmin"]?>
			
	</button>
    </div>
    </div>
</form>

</div>