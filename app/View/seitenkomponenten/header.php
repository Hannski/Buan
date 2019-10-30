<?php
 require "./app/languageCheck.php";
 require "./app/styleCheck.php";
?>
<!DOCTYPE html>
<!-- Sprachinformationen fuer HTML dynamisch anpassen (Default-Wert ist Deutsch) -->
 <html lang="<?php  echo $lang = isset($_SESSION['language']) ? $_SESSION['language'] : "de"; ?>">
 <head>
   <meta charset="UTF-8">
   <title>Buan19</title>
     <!-- Bootstrap Style Einbindung -->

     <!-- Einbinden von JQuery -->
     <script src="./app/jquery.js" integrity="" crossorigin="anonymous"></script>
     <!-- Einbinden Bootstrap.js -->
     <script src="./app/View/styleBootstrap/js/bootstrap.js"></script>
     <!-- Einbinden Bootstrap.CSS -->
     <link rel="stylesheet"  type="text/css" href="./app/View/styleBootstrap/css/bootstrap.min.css"/>
     <!-- Einbinden des Custom Styles, wenn User diesen gewaelt hatte -->
     <?php 
     // Test: print_r($_SESSION['style']);
     if (isset($_SESSION['style']) && $_SESSION['style'] == "dark") {
      echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"./app/View/styleBootstrap/customStyles/dark.css\">";
     }

     ?>
     

     <!-- Ende Einbinden -->
 </head>
 <body>

