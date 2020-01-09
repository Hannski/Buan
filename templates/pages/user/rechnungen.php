<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 31.12.2019
 * Time: 12:32
 */

?>
<div class="container">
    <div class="row d-flex flex-row align-items-center">
        <!-- Auswahl-->
        <div class="col-12">
            <form class="p-3" method="post" action="" >

                <!-- Jahr und MOnat Auswahl -->
                <label for="jahrMonat" ><?php echo $langArray[$opt]['monatJahr'] ?></label>
                <select name="jahrMonat" id="" class="m-1 form-control">
                    <?php

                    foreach ($wageMonths as $date) {
                        ?>
                            <option value="<?php echo $date->format("Y-m"); ?>"><?php echo $date->format("Y-m");?></option>

                    <?php } ?>

                </select>

                <button type="submit" name="seeWages" class="btn btn-success"><?php echo $langArray[$opt]["search"]?></button>

            </form>
        </div> <!--    Ende Col-12-->