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

                    <div class="card-header border-0">
                                <h5><?php echo $langArray[$opt]['cart']?></h5>
                    </div>
    <div class="card-body border-0">

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
                        <?php echo $menge."x".$preis." €"; ?>
                    </div>

                <div class="col-12 col-sm-12 col-md-6 col-lg-6 text-center">
                    <img class="img-responsive" src="<?php echo "./Assets/".$dateiname?>" alt="prewiew" width="120" height="100 ">
                </div>

                <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
                    <h4 class="product-name"><strong><?php echo $out = ($lang == 1 ?  $nameEn :  $nameDe)?></strong></h4>
                </div>
                    <div class="col-12 col-sm-12 col-md-12 text-sm-left text-md-center p-4" >
                        <?php echo $langArray[$opt]['subTotal'].$gesamtpreis." €"; ?>
                    </div>
                </div>
                <hr>
            <div class="row">
                <div class="col-12 col-sm-12 text-sm-center col-md-12">

                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="hidden" name="menge" value="<?php echo $menge ?>">
                        <input type="number"  name="quan" placeholder="<?php echo $menge?>">
                        <button type="submit" name = "updateQuan" class="btn btn-outline-success btn-xs">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                        </button>
                    </form>
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="hidden" name="menge" value="<?php echo $menge ?>">
                        <button type="submit" name = "unselectItem" class="btn btn-outline-danger btn-xs">
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
                <!--Ende card-->
            </div>




        <div class=" card col-xs-12 col-sm-12 col-md-12 col-lg-3 p-0 ">
            <div class="card-header">
                <h5><?php echo $langArray[$opt]['deliverInfo'] ?></h5>
            </div>
            <div class="row text-md-center text-lg-center p-5">
                <div class="col-12 p-1 text-center">



                    <ul class="list-group list-group-flush ">
                        <?php
                        //Adresse bereits eingegeben
                        if(!empty($adressArray))
                        {
                        foreach ($adressArray as $item)
                        {

                        echo "<li class=\"data list-group-item \">".$langArray[$opt]['street'].": ".$item->getStrasse()."</li>";
                        echo "<li class=\"data list-group-item \">".$langArray[$opt]['number'].": ".$item->getNummer()."</li>";
                        echo "<li class=\"data list-group-item \">".$langArray[$opt]['plz'].": ".$item->getPlz()."</li>";
                        echo "<li class=\"data list-group-item \">".$langArray[$opt]['ort'].": ".$item->getOrt()."</li>";
                        echo "<li class=\"data list-group-item \">".$langArray[$opt]['land'].": ".$laender[$opt][$item->getLand()]."</li>";


                        }}else{
                            //noch keine adresse hinterlegt?>
                       <li class="data list-group-item"><?php echo $langArray[$opt]['addAdress'] ?></li>
                        <?php
                        }
                        ?>


                    </ul>

                    <div class="col-12 p-1">
                        <button class="btn btn-secondary btn-sm ">
                            <a href="./user-adresse" class="text-white" role="button"><?php echo $langArray[$opt]['adressChange'] ?></a>
                        </button>
                    </div>


                    <div class="col-12 mt-4">
                        <?php echo $langArray[$opt]['subTotal'].$subTotal." €" ?>
                    </div>


                </div>




                <div class="col-12 m-1 mt-5">
                   <?php if(!empty($adressArray))
                    {

                        echo "<p><b>".$langArray[$opt]['allOk']."</b></p>";
                        ?>
                        <form action="checkout-bestellung" method="POST">
                  <button class="btn btn-success" name="placeOrder">
                      <?php echo $langArray[$opt]['placeOrder']?>
                  </button>
                        </form>
                            <?php
                    }//ende if.
                            ?>
                </div>


            </div>
        </div>
    </div>
</div>







