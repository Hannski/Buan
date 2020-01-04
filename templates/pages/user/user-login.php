<?php 
   /*Template: nutzeranmeldung. Formular fuer die Anmeldung der Nutzer*/
?>
<div class="login h-50 d-flex-flex-col row m-1">
<form method="POST" class="form-signin bg-light container p-4 d-flex-flex-col justify-content-center">
	
	<span><h1><?php echo $langArray[$opt]["adminSignin"]?></h1></span>
	<div class="mt-2 input-group input-group-lg mr-sm-2">
		<?php
		echo "<input class=\"form-control\" type=\"text\"  name=\"username\" placeholder=".$langArray[$opt]['vorname'].">";
		?>
	</div>


	<div class=" mt-2 input-group input-group-lg mr-sm-2">
		<?php
		echo "<input class=\"form-control\" type=\"password\"  name=\"password\" placeholder=".$langArray[$opt]['Pw'].">";
		?>
	</div>
    <!-- Captcha -->
	<div class="mt-2 ">
	<img src= "./app/includes/Captcha.php" alt="captcha">
	</div>

	<div class="mt-2  mb-2 input-group input-group-lg mr-sm-2">
		
      	 <?php
		echo "<input class=\"form-control\" type=\"text\"  name=\"captcha\" placeholder=".$langArray[$opt]['captcha'].">";
		?>
		
	</div>

    <div class="form-row">
        <div class="col-6">
            <button type="submit" class="form-control  btn bnt-lg btn-outline-success" name="userLogin">
                <?php echo $langArray[0]["loginUser"]?>
            </button>
        </div>
        <div class="col-6">
            <button type="" class="form-control  btn bnt-lg btn-outline-success" name="pwForgot">
                <a href="./user-recovery"><?php echo $langArray[0]["pwForgot"]?></a>
            </button>
        </div>




    </div>

</form>
</div>