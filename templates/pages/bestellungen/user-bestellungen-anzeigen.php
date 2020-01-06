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
            <?php

            foreach ($orderArray as $orderId=>$order)
            {
                ?>
                <div class="card-header">
                    <h3><?php echo $order[0]->getDatum(); ?></h3>
                </div>
                <?php
                foreach ($order as $item)
                {

            ?>


            <ul class="list-group list-group-flush text-lg-left text-md-left text-sm-center text-xl-left ">
                <li class="list-group-item-dark list-group-item font-reverse">ArtikelName:<?php echo $item->getPNameD(); ?></span> &nbsp;</li>
                <li class="list-group-item-dark list-group-item font-reverse">Artikel anzahl:&nbsp;<?php ?></li>
                <li class="list-group-item-dark list-group-item font-reverse">Summe:&nbsp;<?php ?></li>
            </ul>
            <!--Card Formular -->


                <?php //ende foreach
                }  ?>
             <div class="card-body">

                     <?php echo "<a class=\"btn btn-success btn-sm\" href=\"user-invoice?id=$orderId\">Rechnung DRucken</a>"; ?>

                    </div>
            <?php }?>

        </div><!-- Card Ende-->

    </div><!-- Anzeige Ende-->

</div><!--    Ende Row-->
</div><!--    Ende Container-->