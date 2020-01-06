<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 05.01.2020
 * Time: 13:51
 */
?>

<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 01.01.2020
 * Time: 12:08
 * Formular fuer den USer: eigene Anmeldedaten Aendern
 */
?>

<div class="container mt-3 h-100">
    <div class="row">
        <?php
        if (!empty($adminArray)){

            foreach ($adminArray as $key){

                $username = $key->getAVorname();
                $pw = $key ->getAPw();
                ?>

                <div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 col-xs-12 card p-0 mr-lg-1 mr-md-1 mr-xl-1 mr-sm-0 mr-xs-0">
                    <div class="card-header"><?php echo $langArray[$opt]['myLoginData']?></div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item font-reverse"><?php echo $langArray[$opt]['username'].": ".$key->getAVorname()."&nbsp;".$key->getANname();?></li>
                    </ul>
                </div>


                <!--            Anmeldeinfos Aendern-->
                <div class="card text-center col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8  p-0">

                    <div class=" card-header border-0 m-0">
                        <h5><?php echo $langArray[$opt]['myLoginData']?></h5>
                    </div>
                    <form action="#" method="post">

                        <div class="bg-white card-body d-flex flex-column align-items-center">

                            <!--Passwort neu -->
                            <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xs-12">
                                <label for="pw1"><?php echo $langArray[$opt]['pwNew']?></label>
                                <input type="password" class="form-control" id="pw1" name="passwortNeu">
                            </div>
                            <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xs-12">
                                <!--Passwort wiederholte Eingabe -->
                                <label for="pw2"><?php echo $langArray[$opt]['pwRepeatNew']?></label>
                                <input type="password" class="form-control" id="pw2" name="passwortMatch">
                            </div>
                            <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xs-12">
                                <!--altes Passwort zum bestaetigen -->
                                <label for="alt"><?php echo $langArray[$opt]['pwOld']?></label>
                                <input type="password" class="form-control" id="alt" name="passwortAlt">
                            </div>

                        </div>


                        <!-- Formular Bestaetigen-->
                        <div class="mt-2 mb-3 input-group input-group-lg mr-sm-2 d-flex flex-column align-items-center">
                            <button class="btn btn-outline-secondary btn-enter" name="password" type="submit">
                                <?php echo $langArray[$opt]['submitUserdata']; ?>
                            </button>
                        </div>
                    </form>
                </div>
                <!--  Ende CardBody-->
                <?php
            }
        }

        //Ende foreach, ende if
        ?>
        <!-- Ende Row -->
    </div>
    <!-- Ende Container -->
</div>
