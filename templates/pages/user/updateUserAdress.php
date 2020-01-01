<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 01.01.2020
 * Time: 12:37
 */?>


<?php
require_once './countries/countries.php';

?>
<div class="container mt-3">
    <div class="row">
        <div class="card text-center col-xs-12 col-sm-12 col-md-12 col-lg-8 mr-lg-2 p-0 mb-4">

            <div class=" card-header border-0">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link " href="./checkout-warenkorb">warenkorb abchecken</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active card" href="./checkout-adressdaten">Adressdaten angeben</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
            </div>
            <div class="bg-white card-body border-0 p-5">

                <form action="#" method="post">
                    <!-- BEschreibung -->

                    <div class="mt-2 text-center  mr-sm-2">
                        <h1>Adresse</h1>
                    </div>
                    <!-- Strasse -->
                    <div class="mt-2 input-group input-group-lg mr-sm-2">
                        <?php
                        echo "Strasse:&nbsp; <input class=\"form-control\" type=\"text\"  name=\"strasse\">";
                        ?>
                    </div>
                    <!-- Hausnummer -->
                    <div class="mt-2 input-group input-group-lg mr-sm-2">
                        <?php
                        echo "Hausnummer:&nbsp;&nbsp;<input class=\"form-control\" type=\"number\"  name=\"nummer\">&nbsp;&nbsp;";
                        echo "Plz.:&nbsp; <input class=\"form-control\" type=\"number\"  name=\"plz\">";
                        ?>
                    </div>
                    <!-- Ort -->

                    <div class="mt-2 input-group input-group-lg mr-sm-2">
                        <?php
                        echo "Ort:&nbsp;&nbsp; <input class=\"form-control\" type=\"text\"  name=\"ort\">";
                        ?>
                    </div>
                    <!--Auswahl Land-->
                    <div class="mt-2 input-group input-group-lg mr-sm-2">
                        <select name="land" class="custom-select">
                            <option value="" selected disabled hidden>Choose here</option>
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
                        <button class="btn btn-lg btn-success" name="adress" type="submit">Adresse bestaetigen</button>
                    </div>
                    <!-- Formular Bestaetigen ENDE-->
                </form>
            </div>
        </div>
