<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 31.12.2019
 * Time: 14:57
 */  ?>


<!--    anzeige-->
    <div class="col-12">
<div class="col-12 text-center"><?php echo $langArray[$opt]['bestellungenSee']?></div>

        <div class="card mt-2 mb-2">
            <?php

            foreach ($orderArray as $orderId=>$order)
            {
                ?>
                <div class="card-header">
                    <h3><?php $date=date("d.m.Y",strtotime($order[0]->getDatum()));echo $date; ?></h3>
                </div>
                <?php
                foreach ($order as $item)
                {
            ?>


            <ul class="list-group list-group-flush text-lg-left text-md-left text-sm-center text-xl-left ">
                <li class="list-group-item-dark list-group-item font-reverse">
                    <?php echo $langArray[$opt]['productName']?>: <?php echo $opt==0? $item->getPNameD():$item->getPNameE(); ?></span> &nbsp
                </li>
                <li class="list-group-item-dark list-group-item font-reverse">
                    <?php echo $langArray[$opt]['anzahl']?>: &nbsp;<?php echo $item->getMenge();?>
                </li>
                <li class="list-group-item-dark list-group-item font-reverse">
                    <?php echo $langArray[$opt]['singlePrice']?>: &nbsp;<?php echo $item->getPreis();?> EUR
                </li>
                <li class="list-group-item-dark list-group-item font-reverse">
                    <?php echo $langArray[$opt]['subTotal']?>:&nbsp;<?php echo $item->getMenge() * $item->getPreis()?> EUR
                </li>
            </ul>
            <!--Card Formular -->


                <?php //ende foreach
                }  ?>
             <div class="card-body">

                     <?php echo "<a class=\"btn btn-success btn-sm\" href=\"user-invoice?id=$orderId\">".$langArray[$opt]['PrintInvoice']."</a>"; ?>

                    </div>
            <?php }?>

        </div><!-- Card Ende-->

    </div><!-- Anzeige Ende-->

</div><!--    Ende Row-->
</div><!--    Ende Container-->