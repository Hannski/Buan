<?php
require_once './countries/countries.php';

?>
<div class="container mt-3">
    <div class="row">
        <div class="card text-center col-xs-12 col-sm-12 col-md-12 col-lg-8 mr-lg-2 p-0 mb-4">

            <div class=" card-header border-0">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link " href="./checkout-warenkorb"><?php echo $langArray[$opt]['cart']?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active card" href="./checkout-adressdaten"><?php echo $langArray[$opt]['adressHead']?></a>
                    </li>
                </ul>
            </div>
            <div class="bg-white card-body border-0 p-5">

<!--                Formular   -->
                <?php if(empty($adressArray))
                {?>
                <form action="#" method="post">
                <!-- BEschreibung -->

    <div class="mt-2 text-center  mr-sm-2">
		<h3 class="font-reverse"><?php echo $langArray[$opt]['adressHead']?></h3>
	</div>
                <!-- Strasse -->
	<div class="mt-2 input-group input-group-lg mr-sm-2 font-reverse">
      	 <?php
		echo $langArray[$opt]['street'].":&nbsp; <input class=\"form-control\" type=\"text\"  name=\"strasse\">";
		?>
	</div>
                <!-- Hausnummer -->
    <div class="mt-2 input-group input-group-lg mr-sm-2 font-reverse">
    <?php
	    echo  $langArray[$opt]['number']."&nbsp;:&nbsp;<input class=\"form-control\" type=\"number\"  name=\"nummer\">&nbsp;&nbsp;";
	    echo   $langArray[$opt]['plz'].":&nbsp;<input class=\"form-control\" type=\"number\"  name=\"plz\">";
	?>
	</div>
                <!-- Ort -->

    <div class="mt-2 input-group input-group-lg mr-sm-2 font-reverse">
	 <?php
		echo $langArray[$opt]['ort'].":&nbsp;<input class=\"form-control\" type=\"text\"  name=\"ort\">";
	 ?>
	</div>
                <!--Auswahl Land-->
		<div class="mt-2 input-group input-group-lg mr-sm-2 font-reverse">
           <select name="land" class="custom-select">
               <option value=""  class="font-reverse" selected disabled hidden><?php echo $langArray[$opt]['pickLand']?></option>
               <?php
                /* laenderarray extern eingebunden-> language auswahl uebertragen aus gespeichertem Session-wert*/
               foreach($laender as $code)
                {?>
            <?php
            foreach ($code as $key=>$value)
            {?>
                <option value="<?php echo $key ?>"><?php   echo $laender[$opt][$key] ?></option>
            <?php
            }}?>
           </select>
	    </div>
                <!-- ENDE Auswahl Land-->
                <!-- Formular Bestaetigen-->
                <div class="mt-2 input-group input-group-lg mr-sm-2 d-flex flex-column align-items-center">
                    <button class="btn btn-lg btn-success" name="adress" type="submit"><?php echo $langArray[$opt]['submitAdress']?></button>
                </div>
                <!-- Formular Bestaetigen ENDE-->
            </form>
                <?php }else{?>
                    <button class="btn btn-success"><?php echo $langArray[$opt]['placeOrder']?></button>

            <?php  } // Ende else?>
            </div>
<!--            Ende Card Body-->
        </div>
        <div class=" card col-xs-12 col-sm-12 col-md-12 col-lg-3 border  p-5">
            <div class="row text-md-center text-lg-center">
                <div class="col-12 p-1 text-center">
                    <span><?php echo $langArray[$opt]['deliverInfo'] ?></span>
                    <hr>
                    <ul class="list-group list-group-flush ">
        <?php
        //
        if(!empty($adressArray))
        {
            foreach($adressArray as $key){
            $land = $key->getLand();
            $ort = $key->getOrt();
            $str = $key->getStrasse();
            $plz = $key->getPlz();
            $nummer = $key->getNummer();
            ?>

                        <li class="data list-group-item">Strasse: <?php echo $str  ?></li>
                        <li class="data list-group-item">Hausnummer <?php echo $nummer ?></li>
                        <li class="data list-group-item">Plz <?php echo $plz ?></li>
                        <li class="data list-group-item">Ort: <?php echo $ort ?></li>
                        <li class="data list-group-item">Land:<?php echo $laender[$opt][$land] ?></li>
                        <?php // Ende foreach
                        }
                        //ende if
                        }else{?>
                        noch keine Informationen
                       <?php } //ende else?>
                    </ul>
                    <hr>
                    <div class="col-12 p-1">
                        Gesamtsumme: <?php echo $_SESSION['total']; ?>
                    </div>

                </div>

            </div>
        </div>
<!--        ende row-->
    </div>
<!--  Ende container-->
</div>

