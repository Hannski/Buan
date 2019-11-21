
<div class="login h-50 d-flex-flex-col row m-1">
<form method="POST" class="form-signin bg-light container p-4 d-flex-flex-col justify-content-center">
	
	<span><h1><?php echo $langArray[0]["adminSignin"]?></h1></span>
	<div class=" h-25 input-group input-group-lg mr-sm-2">
		<?php
		echo "<input class=\"form-control\" type=\"text\"  name=\"name\" placeholder=".$langArray[$opt]['PlatzhalterVorname'].">";
		?>
	</div>
	<div class=" h-25 input-group input-group-lg mr-sm-2">
		<?php
		echo "<input class=\"form-control\" type=\"text\"  name=\"nachname\" placeholder=".$langArray[$opt]['PlatzhalterNname'].">";
		?>
	</div>

	<div class=" h-25 input-group input-group-lg mr-sm-2">
		<?php
		echo "<input class=\"form-control\" type=\"password\"  name=\"password\" placeholder=".$langArray[$opt]['PlatzhalterPw'].">";
		?>
	</div>
	<button type="submit" class=" m-2 btn bnt-lg btn-outline-success my-2 my-sm-0" name="a_login">
		<?php echo $langArray[0]["loginButton"]?>
			
	</button>
	
</form>
</div>