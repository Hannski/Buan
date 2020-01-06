<?php

?>


<div class="container">
    <div class="row">
        <div class="col-12">
        <div class="card p-0">

            <div class="card-header">
               <h3>gehaelter</h3>
            </div>


        <div class="col-12 card-img-top pt-3">
            <?php
               echo "<img src=\"".WEB_ROOT."/wages-diagramm?jahr=$jahr&monat=$monat\" alt=\"uebersicht\">";
            ?>
        </div>
           <div class="card-body">
               <ul class="list-group list-group-flush">
                   <li class="text-danger list-group-item">Basisgehalt: 3000 Euro</li>
                   <li class="text-success list-group-item">Bonus im Monat:<?php echo $monat."/".$jahr.":&nbsp;".$bonus ?></li>
                   <li class="text-black-50 list-group-item" > Brutto Einkommen :<?php echo 3000+$bonus ?> Euro</li>

               </ul>
               <div class="col-12 p-3">

                   <?php echo "<a class=\"btn btn-outline-secondary\" target=\"_blank\" href=".WEB_ROOT."wages-gehaltsabrechnung?monat=".$monat."&jahr=".$jahr.">Rechnung DRucken (pdf)</a>";?>

               </div>
           </div>

            <!-- ende card-->
        </div>
    </div>
    </div>
</div>
