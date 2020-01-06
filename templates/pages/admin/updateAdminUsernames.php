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
        $vorname = $admin->getAVorname();
        $nachname = $admin->getANname();
        $pw = $admin ->getAPw();
        ?>

            <div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 col-xs-12 card p-0 mr-lg-1 mr-md-1 mr-xl-1 mr-sm-0 mr-xs-0">
                <div class="card-header"><?php echo $langArray[$opt]['myLoginData']?></div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item font-reverse"><?php echo $langArray[$opt]['vorname'].": ".$vorname;?></li>
                    <li class="list-group-item font-reverse"><?php echo $langArray[$opt]['nachname'].": ".$nachname;?></li>
                </ul>
            </div>


<!--            Anmeldeinfos Aendern-->
                <div class="card text-center col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8  p-0">

                    <div class=" card-header border-0 m-0">
                        <h5><?php echo $langArray[$opt]['myLoginData']?></h5>
                    </div>
                    <form action="#" method="post">

                        <div class="bg-white card-body">
                            <div class="form-group d-flex flex-column align-items-center">
                                <!--Vornamen aendern -->
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="vorname"><?php echo $langArray[$opt]['username']?></label>
                                    <input type="text" id="vorname" class="form-control" name="vorname">
                                </div>
                                <!--Nachnamen aendern -->
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="nachname"><?php echo $langArray[$opt]['username']?></label>
                                    <input type="text" id="nachname" class="form-control" name="nachname">
                                </div>
                            </div>
                        </div>

                        <!-- Formular Bestaetigen-->
                        <div class="mt-2 input-group input-group-lg mr-sm-2 d-flex flex-column align-items-center">
                            <button class="btn btn-outline-secondary btn-enter" name="updateCredentials" type="submit">
                                <?php echo $langArray[$opt]['submitUserdata']; ?>
                            </button>
                        </div>
                    </form>
                </div>
<!--  Ende CardBody-->

    <!-- Ende Row -->
</div>
<!-- Ende Container -->
</div>