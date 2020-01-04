<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 31.12.2019
 * Time: 14:57
 */  ?>


<!--    anzeige-->
    <div class="col-12">
<div class="col-12 text-center"> Das Ergebnis ihrer Anfrage: Achtung: Ergebnise werden zurzeit noch nach Tag angezeigt. wir arebeiten dran</div>

        <div class="card mt-2 mb-2">
            <form action="" method="post" >
                hii
            <?php

            foreach ($orderArray as $item ){


               echo $item->getOrderId();

            ?>


            <ul class="list-group list-group-flush text-lg-left text-md-left text-sm-center text-xl-left">
                <li class="list-group-item">Bstellnummer:&nbsp;</li>
                <li class="list-group-item">Artikel anzahl:&nbsp;<?php ?></li>
                <li class="list-group-item">Summe:&nbsp;<?php ?></li>
            </ul>
            <!--Card Formular -->


                <?php //ende foreach
                } ?>
                <div class="card-body">

                        <button type="submit" class="btn btn-success  btn-sm"> Rechnung ansehen/drucken</button>

            </div>
            </form>  <!--Card Formular -->
        </div><!-- Card Ende-->

    </div><!-- Anzeige Ende-->

</div><!--    Ende Row-->
</div><!--    Ende Container-->