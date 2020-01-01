<?php 
   /*Template: nutzeranmeldung. Formular fuer die Anmeldung der Nutzer*/
?>
<div class="login h-50 d-flex-flex-col row m-1">
<form method="POST" class="form-signin bg-light container p-4 d-flex-flex-col justify-content-center">
	
	<span><h1><?php echo $langArray[$opt]["adminSignin"]?></h1></span>
	<div class="mt-2 input-group input-group-lg mr-sm-2">
		<?php
		echo "<input class=\"form-control\" type=\"text\"  name=\"username\" placeholder=".$langArray[$opt]['PlatzhalterVorname'].">";
		?>
	</div>


	<div class=" mt-2 input-group input-group-lg mr-sm-2">
		<?php
		echo "<input class=\"form-control\" type=\"password\"  name=\"password\" placeholder=".$langArray[$opt]['PlatzhalterPw'].">";
		?>
	</div>

	<div class="mt-2 ">
	<img src= "./app/includes/Captcha.php" alt="captcha">
	</div>

	<div class="mt-2 input-group input-group-lg mr-sm-2">
		
      	 <?php
		echo "<input class=\"form-control\" type=\"text\"  name=\"captcha\" >";
		?>
		
	</div>

	<button type="submit" class=" m-2 btn bnt-lg btn-outline-success my-2 my-sm-0" name="a_login">
		<?php echo $langArray[0]["loginButton"]?>
			
	</button>
	<!-- Captcha -->
</form>
</div>