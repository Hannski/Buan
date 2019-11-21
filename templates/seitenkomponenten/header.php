<!DOCTYPE html>
<!-- Sprachinformationen fuer HTML -->
 <html lang="de">
 <head>
   <meta charset="UTF-8">
   <title>Buan19</title>
     <!-- Bootstrap Style Einbindung -->

     <!-- Einbinden von JQuery -->
     <script src="./app/style/jquery/jquery.js" integrity="" crossorigin="anonymous"></script>
     <!-- Einbinden Bootstrap.js -->
     <script src="./app/style/js/bootstrap.js"></script>
     <!-- Einbinden Bootstrap.CSS -->
     <link rel="stylesheet"  type="text/css" href="style/css/bootstrap.min.css"/>
     <!-- Einbinden des Custom Styles, wenn User diesen gewaelt hatte -->
     <?php 
     //Alternative Stylecheck-Lösung, statt in stylCheck.php
     /* Test: print_r($_SESSION['style']);*/
     if (isset($_SESSION['style']) && $_SESSION['style'] == "dark") {
      echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"./style/customStyles/dark.css\">";
     }
     
     ?>
     

     <!-- Ende Einbinden -->
 </head>
 <body class="text-center">

