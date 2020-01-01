<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 27.12.2019
 * Time: 13:52
 */
?>

<div class="container mt-3 h-100">
	<div class="row">
			<?php

			foreach ($adminArray as $key){
            $id =$_GET['id'];
	 	 	$vorname = $key->getAVorname();
			$nachname = $key->getANname();
			$status = $key->getStatus();
			?>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

    <div class="card-body  text-center">
         <!-- Vorname -->
    <div class="border-bottom mb-4 p-4">
        <div class="mb-3">Vorname&nbsp;<b><?php echo $vorname ?></b></div>
        <form action="" method="POST">
            <?php
            //aktueller nachname wir mitgesendet um in db zu schauen, ob amdin bereits existiert
            //bei nachname wird vorname mitgesendet
            ?>
            <input type="hidden" name="curName" value="<?php echo $nachname?>">
            <input type="text" name="edit">

            <button type="submit" name="aendern" class="btn btn-sm btn-submit border" value="a_vorname">
            <?php echo $langArray[$opt]["aendern"] ?>
            </button>

        </form>
    </div>
 <!-- Nachname -->
   <div class="border-bottom mb-4 p-4">
        <div class="mb-3">Nachname:&nbsp;<b><?php echo $nachname ?></div>
        <form action="" method="POST">
         <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="hidden" name="curName" value="<?php echo $vorname?>">
         <input type="text" name="edit">

            <button type="submit" name="aendern" class="btn btn-sm btn-submit border" value="a_nname">
            <?php echo $langArray[$opt]["aendern"] ?>
            </button>

        </form>
    </div>

        <!-- Passwort -->
        <div class="border-bottom mb-4 p-4">
            <div class="mb-3">Neues Passwort: </div>
            <form action="" method="POST" class="text-center">
                <input type="text" name="edit"><br>
                <button type="submit" name="aendern" class="btn btn-sm btn-submit border" value="a_pwmd5">
                    <?php echo $langArray[$opt]["aendern"] ?>
                </button>
            </form>

        </div>

     <!-- Status -->
   <div class="border-bottom mb-4 p-4">
        <div class="mb-3">Status:&nbsp;<b><?php echo $status ?></b></div>
        <form action="" method="POST">
         <input type="hidden" name="id" value="<?php echo $id ?>">
            lock: <input type="radio" name="edit" value="1" checked>
            unlock: <input type="radio" name="edit" value="0">

            <button type="submit" name="aendern" class="btn btn-sm btn-submit border" value="gesperrt">
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