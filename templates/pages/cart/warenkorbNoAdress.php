<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 01.01.2020
 * Time: 14:49
 */
?>

<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 29.12.2019
 * Time: 12:42
 */
?>

<script src="https://use.fontawesome.com/c560c025cf.js"></script>

<div class="container mt-2">
    <div class="row">
        <div class="card text-center col-xs-12 col-sm-12 col-md-12 col-lg-8 mr-lg-2 p-0 ">

            <div class="card card-body card-header border-0">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active card" href="./checkout-warenkorb"><?php echo $langArray[$opt]['cart'] ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./checkout-adressdaten"><?php echo $langArray[$opt]['adressHead'] ?></a>
                    </li>
                </ul>
            </div>
            <div class="bg-white card-body border-0">

                <?php
                $lang = $_SESSION['language'];
                //Array zum Sammeln des Gesamtpreises aller einzelartikel
                $total = [];
                foreach ($cartArray as $key) {
                    $id = $key->getItemId();
                    $menge = $key->getMenge();
                    $nameDe = $key->getNameDe();
                    $nameEn = $key->getNameEn();
                    $dateiname = $key->getDateiname();
                    $preis = $key->getPreis();
                    $gesamtpreis = $preis * $menge;
                    $total[] = $gesamtpreis;

                    ?>


                    <!-- PRODUCT -->


                    <div class="border p-3">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 text-sm-left text-md-center p-4" >
                                <?php echo $menge ?> x
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 text-center">
                                <img class="img-responsive" src="<?php echo "./Assets/".$dateiname?>" alt="prewiew" width="120" height="100 ">
                            </div>

                            <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
                                <h4 class="product-name"><strong><?php echo $out = ($lang == 1 ?  $nameEn :  $nameDe)?></strong></h4>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 text-sm-left text-md-center p-4" >
                                <?php echo $langArray[$opt]['subTotal'].$gesamtpreis." €" ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12 col-sm-12 text-sm-center col-md-12">
                                <form action="" method="post">

                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                    <input type="number" step="1"  name="quan" placeholder=" anzahl aendern" >
                                    <button type="button" name = "updateQuan" class="btn btn-outline-success btn-xs">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </button>
                                    <button type="button" name = "unselectItem" class="btn btn-outline-danger btn-xs">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <!--Ende Produkt-->

                    <?php
                }
                //Berechnen der Gesamtsummer des Warenkorbs
                $subTotal = array_sum($total);
                $_SESSION['total'] =$subTotal;
                ?>
                <!-- END PRODUCT -->


            </div>
            <!--Ende card-body-->
        </div>

    </div><!--    Ende Row-->
</div><!--    Ende Container-->





