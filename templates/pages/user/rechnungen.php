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

                    foreach ($orderArray as $item) {
                        $year = $item->getYear();
                        $month = $item->getMonth();
                        ?>
                        <optgroup label="<?php echo $year ?>">
                            <option value="<?php echo $year.'-'.$month ?>"><?php echo $year.'-'.$month?></option>
                        </optgroup>
                    <?php } ?>

                </select>

                <button type="submit" name="seeOrders" class="btn btn-success">suchen</button>

            </form>
        </div> <!--    Ende Col-12-->