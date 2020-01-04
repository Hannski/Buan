<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 04.01.2020
 * Time: 17:06
 */?>


<div class="container">
    <div class="row p-3">
        <div class="card col-12 p-0">
            <!--            Card header-->
            <div class="card-header">
                <h5>WiederherstellungsDaten:</h5>
            </div>
            <!--                Daten-->
            <div class="card-body">
                <?php
                //Array mit wiederherstellungsdaten

                echo  $recoveryArray['username'];
                echo $recoveryArray['pass'];
                ?>
            </div>
            <!--    Ende Card Body-->
        </div>
    </div>
</div>
