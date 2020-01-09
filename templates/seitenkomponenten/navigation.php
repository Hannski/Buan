<?php
/*
 * Navigationsleiste. Je nachdemm welche Rolle der aktuelle User einnnimmt(keine,User,admin oder Superadmin),
 * werden verschiedene Optionen angeboten:
 *Superadmin: alle Aenderungesmoeglichkeiten fuer Administratoren,Produkte,user,abmelden als superadmin
 * User: abmelden als user, passwort,username,adresse -aendern, meine bestellungen, einkaufswagen, gehaelter und boni
 * Admin- wie superadmin minus dem recht Administratoren hinzuzufuegen oder zu aendern.
 *
 */
//falls keine Session gestartet wurde, starten
if(session_status() == PHP_SESSION_NONE){
    session_start();
    }
?>
<!--Navigationsleiste teilweise kopiert von: https://getbootstrap.com/docs/4.3/components/navbar/	 -->
	<nav class="navbar custom-vg navbar-expand-lg navbar-light bg-light" id="nav">
  <a class="navbar-brand" href="<?php echo WEB_ROOT ?>">Buan19</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
<!--Style Auswahl-->
  <div class="collapse navbar-collapse " id="navbarSupportedContent">
    <form method ="POST" action="">
      <div class="border m-1">
      <button class="btn btn-sm btn-outline my-1 my-sm-0" type="submit" name="style" value="dark"><?php echo $langArray[$opt]["styleDark"]?></button>/
      <button class="btn btn-sm btn-outline my-1 my-sm-0" type="submit" name="style" value="light"><?php echo $langArray[$opt]["styleLight"]?></button>
    </div>
    </form>
<!--  Sprachauswahl-->
    <form method ="POST" action="">
      <div class="border m-1">
      <button class="btn btn-sm btn-outline my-1 my-sm-0" type="submit" name="language" value="de">De</button>/
      <button class="btn btn-sm btn-outline my-1 my-sm-0" type="submit" name="language" value="en">En</button>
    </div>
    </form>

<!--      Ende Navbar fuer alle User-Rollen -->



<!-- Rolle des Nutzenden= USer -->
<?php

if(isset($_SESSION['user']) && $_SESSION['user']=='loggedIn')
{
    echo "<ul class=\"navbar-nav mr-auto\">";
    //user abmelden
    echo "<a class=\"nav-link\" href=\"".WEB_ROOT."user-logout\">".$langArray[$opt]['outA']." ".$_SESSION['username']." ".$langArray[$opt]['outB']."</a></li>";
    echo "<a class=\"nav-link\" href=\"".WEB_ROOT."user-home\">".$langArray[$opt]['shop']."</a></li>";
    //user: uebersicht ueber bestellungen
    echo "  <li class=\"nav-item\"><a class=\"nav-link\" href=\"".WEB_ROOT."user-bestellungen\">".$langArray[$opt]['myOrders']."</a></li>";
    //user: Nutzerdaten 'passwort,'username','adresse' -aendern
    ?>
    <!-- Dropdown: Userdaten -->
    <li class="nav-item dropdown">
        <!-- ueberschrift -->
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $langArray[$opt]['myUserData']?>
        </a>

        <div class="dropdown-menu bg-light" aria-labelledby="navbarDropdown">
            <!-- Username bearbeiten -->
            <?php echo"<a class=\"dropdown-item\" href=\"".WEB_ROOT."user-daten\">".$langArray[$opt]['myLoginData']."</a>";?>
            <!-- Passwort bearbeiten -->
            <div class="dropdown-divider"></div>
            <?php echo"<a class=\"dropdown-item\" href=\"".WEB_ROOT."user-passwort\">".$langArray[$opt]['myPasswordData']."</a>";?>
            <div class="dropdown-divider"></div>
            <!-- AAdressdaten bearbeiten -->
            <a class="dropdown-item" href="<?php echo WEB_ROOT ?>user-adresse"> <?php echo $langArray[$opt]['myAdressData']?></a>
        </div>
    </li>
        <?php //user Gehaltuebersicht ?>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo WEB_ROOT ?>wages-overview"><?php echo $langArray[$opt]['myPayData']?></a>
    </li>
<!--        Ende nav-links-->

    </ul>


      <ul class="navbar-nav mr-1">
          <li class="nav-item ">
              <button class="btn btn-outline-secondary">
                  <a class="nav-link" href="<?php echo WEB_ROOT ?>checkout-warenkorb">
                      <?php echo $langArray[$opt]['cart']?>
                  </a>
              </button>
          </li>
      </ul>
<!--      Ende nav-rechts-->
        <?php
}//ende USerRolle= User




//userRolle= admin
elseif(isset($_SESSION['admin']) && $_SESSION['admin']=='loggedIn')
{   echo "<ul class=\"navbar-nav mr-auto\">";
    echo "<li class=\"nav-item \"><a class=\"nav-link\" href=\"".WEB_ROOT."admin-logout\">".$langArray[$opt]['outA'].$_SESSION['admin']." ".$langArray[$opt]['outB']."</a></li>";
    ?>
    <li class="nav-item"><a class="nav-link" href="<?php echo WEB_ROOT ?>admin-monthlyorders"><?php echo $langArray[$opt]['monthlyOrders']?></a></li>
    <!--      Produkte verwaltung-->
    <!-- Dropdown: Produkteoptionen -->
    <li class="nav-item dropdown">
        <!-- ueberschrift -->
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <?php echo $langArray[$opt]['produkte'];?>
        </a>

        <div class="dropdown-menu bg-light" aria-labelledby="navbarDropdown">
            <!-- Produkte einstellen -->
            <?php echo"<a class=\"dropdown-item\" href=\"".WEB_ROOT."produkt-erstellen\">".$langArray[$opt]['p_einstellen']."</a>";?>
            <div class="dropdown-divider"></div>
            <!-- Alle produkte Verwalten -->
            <a class="dropdown-item" href="<?php echo WEB_ROOT ?>produkt-verwalten"><?php echo $langArray[$opt]['manageP']; ?></a>

        </div>
    </li>

    <!-- Dropdown Nutzeroptionen-->
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $langArray[$opt]['Users']?>
        </a>
        <div class="dropdown-menu bg-light" aria-labelledby="navbarDropdown">
            <!-- Nutzer authorisieren -->
            <a class="dropdown-item" href="<?php echo WEB_ROOT ?>user-authorisierung"><?php echo $langArray[$opt]['authU']; ?></a>
            <div class="dropdown-divider"></div>
            <!-- Alle produkte Verwalten -->
            <a class="dropdown-item" href="<?php echo WEB_ROOT ?>user-verwalten"><?php echo $langArray[$opt]['manageU']; ?></a>

        </div>
    </li>

<!--    DRopdown eigene DAten anpassen -->
<!-- Dropdown Nutzeroptionen-->
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
           role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Meine Nutzerdaten
        </a>
        <div class="dropdown-menu bg-light" aria-labelledby="navbarDropdown">
            <!-- Username aendern -->
            <a class="dropdown-item" href="<?php echo WEB_ROOT ?>admin-credentials"><?php echo $langArray[$opt]['adminCreds']; ?></a>
            <div class="dropdown-divider"></div>
            <!-- PAsswort aendern -->
            <a class="dropdown-item" href="<?php echo WEB_ROOT ?>admin-password"><?php echo $langArray[$opt]['adminPW']; ?></a>

        </div>
    </li>





    <?php echo "</ul>";
}
//user= superadmin abmelden
elseif(isset($_SESSION['super']) && $_SESSION['super']=='loggedIn')
{
    echo "<ul class=\"navbar-nav mr-auto\">";
    echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"".WEB_ROOT."admin-logout\">".$langArray[$opt]['outA'].$_SESSION['superName']." ".$langArray[$opt]['outB']."</a></li>";

    ?>
    <li class="nav-item"><a class="nav-link" href="<?php echo WEB_ROOT ?>admin-monthlyorders"><?php echo $langArray[$opt]['monthlyOrders']?></a></li>
<!--      Produkte verwaltung-->
    <!-- Dropdown: Produkteoptionen -->
    <li class="nav-item dropdown">
        <!-- ueberschrift -->
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $langArray[$opt]['produkte'];?>
        </a>

        <div class="dropdown-menu bg-light" aria-labelledby="navbarDropdown">
            <!-- Produkte einstellen -->
            <?php echo"<a class=\"dropdown-item\" href=\"".WEB_ROOT."produkt-erstellen\">".$langArray[$opt]['p_einstellen']."</a>";?>
            <div class="dropdown-divider"></div>
            <!-- Alle produkte Verwalten -->
            <a class="dropdown-item" href="<?php echo WEB_ROOT ?>produkt-verwalten"><?php echo $langArray[$opt]['manageP']; ?></a>

        </div>
    </li>

    <!-- Dropdown Nutzeroptionen-->
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Nutzer
        </a>
        <div class="dropdown-menu bg-light" aria-labelledby="navbarDropdown">
            <!-- Nutzer authorisieren -->
            <a class="dropdown-item" href="<?php echo WEB_ROOT ?>user-authorisierung"><?php echo $langArray[$opt]['authU']; ?></a>
            <div class="dropdown-divider"></div>
            <!-- Alle produkte Verwalten -->
            <a class="dropdown-item" href="<?php echo WEB_ROOT ?>user-verwalten"><?php echo $langArray[$opt]['manageU']; ?></a>

        </div>
    </li>


    <!-- Dropdown Administratoren  Optionen-->
    <li class="nav-item dropdown">
        <!-- ueberschrift -->
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Admins
        </a>

        <div class="dropdown-menu bg-light" aria-labelledby="navbarDropdown">
            <!-- Admins einstellen -->
            <a class="dropdown-item" href="<?php echo WEB_ROOT ?>admin-erstellen"><?php echo $langArray[$opt]['createA']; ?></a>
            <div class="dropdown-divider"></div>
            <!-- Admins Verwalten -->
            <a class="dropdown-item" href="<?php echo WEB_ROOT ?>admin-verwaltung"><?php echo $langArray[$opt]['manageA']; ?></a>

        </div>
    </li>



    <?php
    echo " </ul>";
}
?>


  </div>
</nav>
<!-- Ende Navigationsleiste -->



