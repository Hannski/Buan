<?php
?>
<!--Einstellen von Dateien-->
<div class="container-fluid">
<div class="row d-flex justify-content-center">
	<div class="mt-3 col-12 text-center border bg-light"><h4><?php echo $langArray[$opt]['p_add_label'];?></h4></div>

<form action="" method="POST" class="col-md-6 col-sm-12 col-lg-6 mt-4 mb-4" enctype="multipart/form-data">
	
	<div class=" h-25 m-1 input-group d-flex align-items-center">
		<h5 class="col-md-12 col-xs-12 col-lg-12"> <?php echo $langArray[$opt]['pd_name'];?>: &nbsp; </h5>
		<?php
		echo "<input class=\"col-md-12 col-xs-12 col-lg-12 form-control\" type=\"text\"  name=\"pd_name\" placeholder=".$langArray[$opt]['Platzh_P_Name'].">";
		?>
	</div>
	
	<div class=" h-25 m-1 input-group d-flex align-items-center">
		<h5 class="col-md-12 col-xs-12 col-lg-12"><?php echo $langArray[$opt]['pe_name'];?>: &nbsp; </h5>
		<?php
		echo "<input class=\"form-control col-md-12 col-xs-12 col-lg-12\" type=\"text\"  name=\"pe_name\" placeholder=".$langArray[$opt]['Platzh_P_Name'].">";
		?>
	</div>
	
	<div class=" h-25 m-1 input-group d-flex align-items-center">
		<h5 class="col-md-12 col-xs-12 col-lg-12"><?php echo $langArray[$opt]['pd_des'];?>: &nbsp; </h5>
		<?php
		echo "<textarea id=\"comment\" rows=\"3\" class=\"form-control col-md-12 col-xs-12 col-lg-12\" type=\"text\"  name=\"pd_beschreibung\" placeholder=".$langArray[$opt]['Platzh_P_beschr']."></textarea>";
		?>
	</div>
	
	<div class=" h-25 m-1 input-group d-flex align-items-center">
		<h5 class="col-md-12 col-xs-12 col-lg-12"><?php echo $langArray[$opt]['pe_des'];?>: &nbsp; </h5>
		<?php
		echo "<textarea id=\"comment\" rows=\"3\" class=\"form-control col-md-12 col-xs-12 col-lg-12\" type=\"text\"  name=\"pe_beschreibung\" placeholder=".$langArray[$opt]['Platzh_P_beschr']."></textarea>";
		?>
	</div>
	
	<div class=" h-25 m-1 input-group d-flex align-items-center">
		<h5 class="col-md-12 col-xs-12 col-lg-12"><?php echo $langArray[$opt]['Platzh_P_preis'];?>: &nbsp; </h5>
		<?php
		echo "<input class=\"form-control col-md-12 col-xs-12 col-lg-12\" type=\"number\"  name=\"p_preis\" placeholder=".$langArray[$opt]['Platzh_P_preis'].">";
		?>
	</div>
	<div class=" h-25 m-1 input-group d-flex align-items-center">
		<h5 class="col-md-12 col-xs-12 col-lg-12">Bestand:</h5>
		<?php
		echo "<input class=\"form-control col-md-12 col-xs-12 col-lg-12\" type=\"number\"  name=\"menge\" placeholder=".$langArray[$opt]['Platzh_P_preis'].">";
		?>
	</div>
	
	<div class=" h-25 m-1 input-group d-flex align-items-center">
	<div class="input-group mb-3">
	  <div class="h-25 m-1 input-group d-flex align-items-center">
	  	<div class="col-4"></div>
	    <input type="file" name="dateiname" class="" id="inputGroupFile01">
	    <div class="col-4"></div>
	  </div>
	</div>
	</div>
	
	<div class="form-row text-center mb-5">
    <div class="col-12">
        <button type="submit"  name="add_p" class="btn btn-primary"><?php echo $langArray[$opt]['btn_p_add'];?></button>
    </div>
 	</div>

</form>
</div>
</div>