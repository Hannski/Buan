
<div class="container mt-3 h-100">
	<div class="row">
			<?php
			foreach ($userArray as $key){

	 	 	$username = $key->getUsername();
			$status = $key ->getStatus();
			?>
	<div class="card col-12 p-0">

    <div class="card-header">
        <h6><?php echo $langArray[$opt]["changeDataForUser"]." : ".$username ?></h6>
    </div>



    <div class="card-body ">
        <form action="" method="POST">
         <!--Username -->
    <div class="form-group">
        <label for="username" ><?php echo $langArray[$opt]['username']?>:&nbsp;<b><?php echo $username ?></b></label>
         <input class="form-control" type="text" id="username" name="username">
    </div>
            <div class="form-group">
                <button type="submit" name="aendern" class="btn btn-sm btn-submit border" value="username">
                    <?php echo $langArray[$opt]["aendern"] ?>
                </button>
            </div>
        </form>


        <!-- Neues Passwort -->
        <form action="" method="post">
        <div class="form-row mt-2 mb-3 ">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <label for="passwortNeu" ><?php echo $langArray[$opt]['pwNew']?>:&nbsp</label>
                <input class="form-control" type="password" id="passwortNeu" name="passwortNeu">
            </div>
            <!--neues Passwort wiederholen -->
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <label for="passwortMatch" ><?php echo $langArray[$opt]['PwRepeat']?>:&nbsp</label>
                <input class="form-control" type="password" id="passwortNeu" name="passwortMatch">
            </div>
        </div>
        <div class="form-row mb-3">
            <div class="col-12">
            <button type="submit" name="aendern" class="btn btn-sm btn-submit border" value="passwort">
                <?php echo $langArray[$opt]["aendern"] ?>
            </button>
            </div>
        </div>
        </form>

        <div class="border-top mb-2"&nbsp; </div>

 <!-- Sperrstatus -->
        <form action="" method="post">
        <div class="form-group mt-2">
            <label for="status">
                <?php echo $langArray[$opt]['status']?>: <b><?php echo $langArray[$opt][$status] ?></b>
            </label>
        </div>

        <div class="form-row p-0 d-flex flex-row align-content-center ">
            <div class="form-check col-6">
            <label class="form-check-label" for="status1"><?php echo $langArray[$opt]['aktiv']?></label>
            <input class="form-check-inline" type="radio" name="status" id="status1" value="0" >
         </div>

        <div class="form-check col-6">
            <label class="form-check-label" for="status2"><?php echo $langArray[$opt]['gesperrt']?></label>
            <input class="form-check-inline" type="radio" name="status" id="status2" value="1">
             </div>

        </div>
            <div class="form-group">
                <button type="submit" name="aendern" class="btn btn-sm btn-submit border" value="status">
                    <?php echo $langArray[$opt]["aendern"] ?>
                </button>
            </div>
        </form>



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
