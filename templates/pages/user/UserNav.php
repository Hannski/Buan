<?php

?>
<!--Navigationsleiste teilweise kopiert von: https://getbootstrap.com/docs/4.3/components/navbar/	 -->
	<nav class="navbar custom-vg navbar-expand-lg navbar-light bg-light" id="nav">
  <a class="navbar-brand" href="#">Buan19</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse " id="navbarSupportedContent">
    <form method ="POST" action="">
      <div class="border m-1">
      <button class="btn btn-sm btn-outline my-1 my-sm-0" type="submit" name="style" value="dark"><?php echo $langArray[$opt]["styleDark"]?></button>/
      <button class="btn btn-sm btn-outline my-1 my-sm-0" type="submit" name="style" value="light"><?php echo $langArray[$opt]["styleLight"]?></button>
    </div>
    </form>
    <form method ="POST" action="">
      <div class="border m-1">
      <button class="btn btn-sm btn-outline my-1 my-sm-0" type="submit" name="language" value="de">De</button>/
      <button class="btn btn-sm btn-outline my-1 my-sm-0" type="submit" name="language" value="en">En</button>
    </div>
    </form>
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
      <?php
      {
          echo "<a class=\"nav-link\" href=\"admin-logout\">".$langArray[$opt]['logout']."</a>";
      }
      ?>
      </li>
        <li class="nav-item">
            <a class="nav-link" href="user-bestellungen"><?php echo $langArray[$opt]['myOrders']?></a>
        </li>


        <!-- Dropdown: Userdaten -->
        <li class="nav-item dropdown">
            <!-- ueberschrift -->
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $langArray[$opt]['myUserData']?>
            </a>

            <div class="dropdown-menu bg-light" aria-labelledby="navbarDropdown">
                <!-- Anmeldedaten bearbeiten -->
                <?php echo"<a class=\"dropdown-item\" href=\"./user-daten\">".$langArray[$opt]['myLoginData']."</a>";?>
                <div class="dropdown-divider"></div>
                <!-- AAdressdaten bearbeiten -->
                <a class="dropdown-item" href="./user-adresse"> <?php echo $langArray[$opt]['myAdressData']?></a>

            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="user-gehalt"><?php echo $langArray[$opt]['myPayData']?></a>
        </li>
    </ul>
      <ul class="navbar-nav mr-1">
          <li class="nav-item ">
              <button class=" btn btn-outline-secondary"><a class="nav-link" href="checkout-warenkorb"><?php echo $langArray[$opt]['cart']?></a></button>
          </li>
      </ul>
  </div>
</nav>
<!-- Ende Navigationsleiste -->



