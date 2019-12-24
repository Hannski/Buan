<?php 
   /*Template:Nutzerregistrierung*/
?>
<div class="login h-50 d-flex-flex-col row m-1">

<form method="POST" class="form-signin bg-light container p-4 d-flex-flex-col justify-content-center">
	
	<span><h1><?php echo $langArray[$opt]["register"]?></h1></span>
	<div class="mt-2 input-group input-group-lg mr-sm-2">

	<input class="form-control" type="text" name="username" placeholder="vorname">

	</div>


	<div class=" mt-2 input-group input-group-lg mr-sm-2">
		<?php
		echo "<input class=\"form-control\" type=\"password\"  name=\"password1\" placeholder=".$langArray[$opt]['PlatzhalterPw'].">";
		?>
	</div>

	<div class="mt-2 input-group input-group-lg mr-sm-2">
		
      	 <?php
		echo "<input class=\"form-control\" type=\"password\"  name=\"password2\" placeholder=".$langArray[$opt]['PlatzhalterPw'].">";
		?>
		
	</div>
<h6>geben Sie eine kurze begründung ein, warum sie beitreten wollen(500 zeichen)</h6>
	<div class="mt-2 input-group input-group-lg mr-sm-2">
		

      	 <?php
      	 /*TODO::Sicherheitslücke-> maxlength zusätzlich in php abfragen*/
		echo "<textarea class=\"form-control\" type=\"textarea\" rows=\"4\"  maxlength=\"500\" name=\"msg\"></textarea>";
		?>
		
	</div>
	
	<div class="mt-2  p-4">
	<button type="submit " class=" m-2 btn bnt-lg btn-outline-success my-2 my-sm-0" name="u_register">
		<?php echo $langArray[$opt]["submitRegister"]?>
			
	</button></div>
	
</form>
</div>