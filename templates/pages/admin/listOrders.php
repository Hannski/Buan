<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 06.01.2020
 * Time: 22:45
 */
require_once BASEPATH."/app/includes/styleCheck.php";
?>

<?php
//gesamtumsatz fuer den Monat berrechnen:
$gesamt=0;
foreach ($orderArray as $order)
{
    $total = $order->getMenge () * $order->getPreis();
    $gesamt=$gesamt+$total;
}

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h3> <?php echo $langArray[$opt]['monthlyTotal']." : ".$gesamt?> Euro</h3>
        </div>
    </div>
    <div class="row">
    <div class="col-12">
        <table class="table table-dark">    <thead>
            <tr>
                <th scope="col">bestellung sperren</th>
                <th scope="col">artikel aus bestellung entfernen</th>
                <th scope="col">order_id</th>
                <th scope="col"><?php echo $langArray[$opt]['datumOrder']?></th>
                <th scope="col"><?php echo $langArray[$opt]['itemID'] ?></th>
                <th scope="col"><?php echo $langArray[$opt]['productName'] ?></th>
                <th scope="col"><?php echo $langArray[$opt]['anzahl'] ?></th>
                <th scope="col"><?php echo $langArray[$opt]['singlePrice'] ?></th>
                <th scope="col"><?php echo $langArray[$opt]['status'] ?></th>
            </tr>
            </thead>
            <tbody>

            <?php
            foreach ($orderArray as $order)
            {
                //Datum Formatieren:
                $bestelldatum = date("d. m. Y", strtotime($order->getDatum()));
                ?>

                <tr>
<!--                    Ganze bestellung sperren-->
                    <form action="" method="post">
                        <th scope="row">
                            <button class="btn btn-outline-secondary" type="submit" name="dropOrder"><?php echo $langArray[$opt]['dropOrder']?></button>
                            <input type="hidden" name="order_id" value="<?php echo $order->getOrderID(); ?>">
                        </th>
                    </form>
<!--einzelnen Artikel aus Bestellung entfernen -->
                    <form action="" method="post">
                        <th scope="row">
                            <button class="btn btn-outline-secondary"  type="submit" name="unlockOrder"><?php echo $langArray[$opt]['retrieveOrder']?></button>
                            <input type="hidden" name="order_id" value="<?php echo $order->getOrderID(); ?>">
                        </th>
                    </form>


                <td><?php  echo $order->getOrderID()?></td>
                <td><?php  echo $bestelldatum ?></td>
                <td><?php  echo $order->getItemID(); ?></td>
                <td><?php  if ($opt==1){ echo $order->getPNameE();}else{echo $order->getPNameD();}?></td>
                <td><?php  echo $order->getMenge() ?></td>
                <td><?php  echo $order->getPreis() ?></td>
                <td><?php  echo $order->getGesperrt() =="0" ?  $langArray[$opt]['active']: $langArray[$opt]['blocked'] ?></td>
                </tr>

            <?php
                //Ende foreach
            }
            ?>

            <tr>


            </tbody>
        </table>
    </div>
    </div>
</div>
