 <div id="message">
 	 <div class="container" >
    <?php
    
    if(isset($_SESSION['errors']))
    {
    	echo "<div class=\"bg-danger\">".$_SESSION['errors']."</div>";
       
        echo "<div class=\"bg-danger\">".$langArray[$opt][$_SESSION['errors']]."</div>";
    }
     if(isset($_SESSION['message']))
    {
    	echo "<div class=\"bg-success\">".$_SESSION['message']."</div>";
    }
 
    ?>
</div>
    </div>

