<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 01.01.2020
 * Time: 12:37
 */ ?>


<?php
require_once './countries/countries.php';

?>
<div class="container mt-3">
    <div class="row">
<!--        Aktuelle Angaben falls vorhanden:-->
        <div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 col-xs-12 card p-0 mr-lg-1 mr-md-1 mr-xl-1 mr-sm-0 mr-xs-0">
            <div class="card-header"><?php echo $langArray[$opt]['myAdressData'];?></div>
            <ul class="list-group list-group-flush ">
                <?php
                //falls user bereits eine Adresse hinterlegt hat:
                if(isset($addressArray)) {
                    foreach ($addressArray as $value) {
                        ?>
                        <li class="list-group-item font-reverse"><?php echo $langArray[$opt]['vorname'] . ": " . $value->getVorname(); ?></li>
                        <li class="list-group-item font-reverse"><?php echo $langArray[$opt]['nachname'] . ": " . $value->getNachname(); ?></li>
                        <li class="list-group-item font-reverse"><?php echo $langArray[$opt]['street'] . ": " . $value->getStrasse(); ?></li>
                        <li class="list-group-item font-reverse"><?php echo $langArray[$opt]['number'] . ": " . $value->getNummer(); ?></li>
                        <li class="list-group-item font-reverse"><?php echo $langArray[$opt]['plz'] . ": " . $value->getPlz(); ?></li>
                        <li class="list-group-item font-reverse"><?php echo $langArray[$opt]['ort'] . ": " . $value->getOrt(); ?></li>
                        <li class="list-group-item font-reverse">
                            <?php echo $langArray[$opt]['land'] . ": " . $laender[$opt][$value->getLand()]; ?>
                        </li>

                    <?php }//ende foreach
                }//Ende if
                else{ ?>
                    <li class="list-group-item font-reverse"><?php echo $langArray[$opt]['noAddress']; ?></li>
                <?php }//ende else ?>
            </ul>
        </div>
<!--        AENDERUNGSFORMULAR-->
        <div class="card text-center col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8  p-0">
            <form action="#" method="post">

                    <!-- BEschreibung -->
                        <div class=" card-header border-0 m-0">
                            <h5>User Adresse</h5>
                        </div>

                <div class="bg-white card-body ">

                        <div class="form-row">
                            <div class="form-group col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xs-12">
                                <!--Vorname-->
                                <label for="vornameInput" >Vorname</label>
                                <input id="vornameInput" class="form-control" type="text"  name="vorname">
                            </div>
                            <!-- Nachname -->
                            <div class="form-group col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xs-12">
                                <label for="nachname" >Nachname</label>
                                <input class="form-control" id="nachname" type="text"  name="nachname">
                            </div>
                        </div>


                    <!-- Strasse -->
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xs-12">
                            <!--altes Passwort zum bestaetigen -->
                            <label for="street" ><?php echo $langArray[$opt]['street']?></label>
                           <input class="form-control" id="street" name="strasse">
                            </div>

                    <!-- Hausnummer -->
                            <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="number" ><?php echo $langArray[$opt]['number']?></label>
                            <input class="form-control" id="number" type="number"  name="nummer">
                            </div>
                        </div>
                    <div class="form-row ">
<!--                        Plz-->
                        <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xs-12">
                            <!--altes Passwort zum bestaetigen -->
                            <label for="plz"><?php echo $langArray[$opt]['plz']?></label>
                            <input type="text" class="form-control" id="plz" name="plz">
                        </div>
                    <!-- Ort -->
                        <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xs-12">
                            <!--altes Passwort zum bestaetigen -->
                            <label for="ort"><?php echo $langArray[$opt]['ort']?></label>
                            <input type="text" class="form-control" id="ort" name="ort">
                        </div>
                    </div>
                    <!--Auswahl Land-->
                    <div class="form-group">
                        <label for="land"><?php echo $langArray[$opt]['land'] ?>&nbsp;</label>
                        <select name="land" id="" class="custom-select">
                            <option value="land" selected><?php echo $langArray[$opt]['pickLand']
                                ?></option>
                            <?php
                            /* laenderarray extern eingebunden-> language auswahl uebertragen aus gespeichertem Session-wert*/
                            foreach ($laender as $code) {
                                ?>
                                <?php
                                foreach ($code as $key => $value) {
                                    ?>
                                    <option value="<?php echo $key ?>"><?php echo $laender[$opt][$key] ?></option>
                                    <?php
                                }
                            } ?>
                        </select>
                    </div>
                    <!-- ENDE Auswahl Land-->

                    <!-- Formular Bestaetigen-->
                    <div class="mt-2 input-group input-group-lg mr-sm-2 d-flex flex-column align-items-center">
                        <button class="btn btn-outline-secondary btn-enter" name="adresse" type="submit">
                            <?php echo $langArray[$opt]['submitUserAdress']; ?>
                        </button>
                    </div>
                    <!-- Formular Bestaetigen ENDE-->
                </div>
            </form>
        </div>
    </div>
    </div>






