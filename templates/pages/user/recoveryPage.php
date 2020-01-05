<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 04.01.2020
 * Time: 16:57
 * Dieses Dokument wird geoeffnet wenn ein User sein Passwort vergessen hat und ein temporaeres Passwort beantragt hat.
 */
    ?>


    <div class="container">
        <div class="row p-3">
            <div class="card col-12 p-0">
                <div class="card-header">
                    <h3>Vorruebergehendes Passwort:</h3>
                </div>
                <div class="card-body d-flex flex-column align-items-center">
                    <a href="./user-recoverydata?hash=<?php echo md5($recoveryArray['username'])?>" target="_blank">daten</a>
                </div>
            </div>
        </div>
    </div>
