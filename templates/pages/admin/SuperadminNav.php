
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

      <!-- Dropdown: Produkte -->
      <li class="nav-item dropdown">
        <!-- ueberschrift -->
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Produkte
        </a>

        <div class="dropdown-menu bg-light" aria-labelledby="navbarDropdown">
         <!-- Produkte einstellen -->
      <?php echo"<a class=\"dropdown-item\" href=".$langArray[$opt]['p_einstellen'].">".$langArray[$opt]['p_einstellen']."</a>";?>
      <div class="dropdown-divider"></div>
        <!-- Alle produkte Verwalten -->
        <a class="dropdown-item" href="./produkte-bearbeiten">produkte-bearbeiten</a>

        </div>
      </li>



      <!-- Dropdown Nutzer -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Nutzer
        </a>
         <div class="dropdown-menu bg-light" aria-labelledby="navbarDropdown">
         <!-- Nutzer authorisieren -->
  <a class="dropdown-item" href="./user-authorisierung">Nutzer authorisieren</a>
      <div class="dropdown-divider"></div>
        <!-- Alle produkte Verwalten -->
        <a class="dropdown-item" href="./nutzer-verwalten">Nutzer Verwalten</a>
  
        </div>
      </li>
      <!-- Dropdown Administratoren -->


          <li class="nav-item dropdown">
        <!-- ueberschrift -->
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Admins
        </a>

        <div class="dropdown-menu bg-light" aria-labelledby="navbarDropdown">
         <!-- Produkte einstellen -->
     <a class="dropdown-item" href="./admin-erstellen">Admin erstellen</a>
      <div class="dropdown-divider"></div>
        <!-- Alle produkte Verwalten -->
        <a class="dropdown-item" href="./admin-verwaltung">Admins bearbeiten</a>

        </div>
      </li>

      
    </ul>
  </div>
</nav>


<!-- Ende Navigationsleiste -->



