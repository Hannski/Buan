<?php

?>


<div class="container">
    <div class="row">
        <div class="col-12">
        <div class="card p-0">

            <div class="card-header">
               <h3><?php echo $langArray[$opt]['Wages'] ?></h3>
            </div>


        <div class="col-12 card-img-top pt-3">
            <?php
               echo "<img src=\"".WEB_ROOT."wages-diagramm?jahr=$jahr&monat=$monat\" alt=\"uebersicht\">";
            ?>
        </div>
           <div class="card-body">
               <ul class="list-group list-group-flush">
                   <li class="text-danger list-group-item"><?php echo $langArray[$opt]['grundeinkommen']?></li>
                   <li class="text-success list-group-item"><?php echo $langArray[$opt]['bonusForMonth']?>

                       <?php echo $monat."/".$jahr.":&nbsp;".$bonus ?>
                   </li>
                   <li class="text-black-50 list-group-item" >
                       <?php echo $langArray[$opt]['brutto']?>
                        :<?php echo 3000+$bonus ?> Euro</li>

               </ul>
               <div class="col-12 p-3">
                   <?php echo "<a class=\"btn btn-outline-secondary\" target=\"_blank\" 
                   href=".WEB_ROOT."wages-gehaltsabrechnung?monat=".$monat."&jahr=".$jahr.">
                    ".$langArray[$opt]['PrintInvoice']."</a>";?>
               </div>
           </div>

            <!-- ende card-->
        </div>
    </div>
    </div>
</div>
