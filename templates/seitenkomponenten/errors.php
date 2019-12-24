 <div id="message">
 	 <div class="container" >
    <?php
    
 foreach ($errorArray as $error)
 {
     echo $langArray[$opt][$error]."<br>";
 }
     if(isset($_SESSION['message']))
    {
    	echo "<div class=\"bg-success\">".$_SESSION['message']."</div>";
    }
 
    ?>
</div>
    </div>

