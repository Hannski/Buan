<?php 
   /*HTML-Header*/
?>
<!DOCTYPE html>
<?php echo "<html lang=".$langArray[$opt]["language"].">";?>
 <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta charset="UTF-8">
   <title>Buan19</title>
     <!-- Bootstrap Style Einbindung -->

     <!-- Einbinden von JQuery src="https://code.jquery.com/jquery-3.4.1.min.js"-->
     <script src="style/jQuery/jquery.js" integrity="" crossorigin="anonymous"></script>
    <script src="../style/jQuery/jquery.js" integrity="" crossorigin="anonymous"></script>
     <!-- Einbinden Bootstrap.js src= "https://getbootstrap.com/" -->
     <script src="style/js/bootstrap.js"></script>
     <script src="../style/js/bootstrap.js"></script>
     <!-- Einbinden Bootstrap.CSS, verschiedene Pfade, je nach Url -->
     <link rel="stylesheet"  type="text/css" href="style/css/bootstrap.css"/>
     <link rel="stylesheet"  type="text/css" href="../style/css/bootstrap.css"/>
     <!-- Einbinden des Custom Styles, wenn User diesen gewaelt hatte -->
     <?php 
     //Alternative Stylecheck-Lösung, statt in stylCheck.php
     /* Test: print_r($_SESSION['style']);*/
     if (isset($_SESSION['style']) && $_SESSION['style'] == "dark")
     {
      echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"./style/customStyles/dark.css\">";
         echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../style/customStyles/dark.css\">";
     }
     
     ?>
     

     <!-- Ende Einbinden -->
 </head>
 <body class="text-center ">
    <!-- Beginn Wrapper -->
<div id="wrap" class ="m-0 p-0">
<div id="main">