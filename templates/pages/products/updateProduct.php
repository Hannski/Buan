
<div class="container mt-3 h-100">
	<div class="row">
			<?php
			foreach ($produkteArray as $key){
			$id = $key->getId();
	 	 	$pDname = $key->getNameDe();
			$pEname = $key->getNameEn();
			$desD = $key->getBeschreibungDe();
			$desE = $key->getBeschreibungEn();
			$preis = $key->getPreis();
			$file = $key->getDateiname();
			$lager = $key->getMenge();
			$status = $key->getStatus();
			?>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="card bg-light" >	
		<div class="text-center">
    	<img  class="mt-2 mb-2 img-thumbnail rounded" src="../Assets/<?php echo $file; ?>" alt="<?php echo $file ?>">
	</div>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="h-25 m-1 input-group d-flex align-items-center">
        <div class="col-4"></div>
        <input type="hidden" name="dateiAlt" value="<?php echo $file ?>">
        <input type="file" name="dateiname">
         <button type="submit" name="dateiname" class="btn btn-sm btn-submit border" value="dateiname">
            <?php echo $langArray[$opt]["aendern"] ?>
            </button>
        <div class="col-4"></div>

        </div>
    </form>
  
 
   
    <div class="card-body  text-center">
 
         <!-- Name Deutsch -->   
    <div class="border-bottom mb-4 p-4">
        <div class="mb-3">Name Deutsch:&nbsp;<b><?php echo $pDname ?></b></div>
        <form action="" method="POST">
         <input type="text" name="name_de">
            
            <button type="submit" name="aendern" class="btn btn-sm btn-submit border" value="name_de">
            <?php echo $langArray[$opt]["aendern"] ?>
            </button>

        </form>
    </div>
 <!-- Name Englisch -->
   <div class="border-bottom mb-4 p-4">
        <div class="mb-3">Name Englisch:&nbsp;<b><?php echo $pEname ?></div>
        <form action="" method="POST">
         <input type="text" name="name_en">
            
            <button type="submit" name="aendern" class="btn btn-sm btn-submit border" value="name_en">
            <?php echo $langArray[$opt]["aendern"] ?>
            </button>

        </form>
    </div>

     <!-- Beschreibung Deutsch -->
   <div class="border-bottom mb-4 p-4">
        <div class="mb-3">Beschreibung Deutsch:&nbsp;<b><?php echo $desD ?></b></div>
        <form action="" method="POST">
         <input type="text" name="desc_de">
            
            <button type="submit" name="aendern" class="btn btn-sm btn-submit border" value="beschreibung_de">
            <?php echo $langArray[$opt]["aendern"] ?>
            </button>

        </form>
    </div>
         <!-- Beschreibung Englisch -->
   <div class="border-bottom mb-4 p-4">
        <div class="mb-3">Beschreibung Englisch:&nbsp;  <b><?php echo $desE ?></b></div>
        <form action="" method="POST">
         <input type="text" name="desc_en">
            <button type="submit" name="aendern" class="btn btn-sm btn-submit border" value="beschreibung_en">
            <?php echo $langArray[$opt]["aendern"] ?>
            </button>

        </form>
    </div>
      <!-- Preis -->
   <div class="border-bottom mb-4 p-4">
        <div class="mb-3">Preis: &nbsp; <b><?php echo $preis ?>€</b></div>
        <form action="" method="POST">
         <input type="number" name="preis">
            
            <button type="submit" name="aendern" class="btn btn-sm btn-submit border" value="preis">
            <?php echo $langArray[$opt]["aendern"] ?>
            </button>

        </form>
    </div>
       <!-- Bestand -->
   <div class="border-bottom mb-4 p-4">
        <div class="mb-3">Lagerbestand:&nbsp;<b><?php echo $lager ?></b></div>
        <form action="" method="POST">
         <input type="number" name="bestand">
            
            <button type="submit" name="aendern" class="btn btn-sm btn-submit border" value="bestand">
            <?php echo $langArray[$opt]["aendern"] ?>
            </button>

        </form>
    </div>
           <!-- status -->
   <div class="border-bottom mb-4 p-4">
        <div class="mb-3">Status:&nbsp;<b><?php echo $status ?></b></div>
        <form action="" method="POST">
        sichtbar: <input type="radio" name="gesperrt" value="0">
         sperren: <input type="radio" name="gesperrt" value="1">
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