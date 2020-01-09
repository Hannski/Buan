<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 06.01.2020
 * Time: 21:56
 */
require_once BASEPATH."/app/includes/styleCheck.php";
?>



<div class="container">
<div class="row d-flex flex-row align-items-center">
<!-- Auswahl-->
    <div class="col-12">
        <form class="p-3" method="post" action="" >

<!-- JAhrauswahl -->


            <select name="jahrMonat" id="" class="m-1 form-control">
               <?php
               foreach ($bestelldaten as $date) {

                $year = $date->getYear();
                $month = $date->getMonth();
                ?>
                   <optgroup label="<?php echo $year ?>">
            <option value="<?php echo $year.'-'.$month ?>"><?php echo $year.'-'.$month?></option>
                   </optgroup>
                <?php } ?>

            </select>

            <button type="submit" name="seeOrders" class="btn btn-success">suchen</button>


        </form>
    </div> <!--    Ende Col-12-->
</div>
</div>