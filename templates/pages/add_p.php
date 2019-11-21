<?php
?>
<!--Einstellen von Dateien-->
<div class="container">
<div class="row d-flex justify-content-center">
	<form action="" method="POST" class="col-md-6 col-sm-12 col-lg-6 mt-4 mb-4">
	<div class="h-25  m-1 mb-4 text-center"><h4>Produkt Informationen</h4></div>
	<div class=" h-25 m-1 input-group d-flex align-items-center">
		<h5>Produkt Name deutsch: &nbsp; </h5>
		<?php
		echo "<input class=\"form-control\" type=\"text\"  name=\"pd_name\" placeholder=".$langArray[$opt]['PlatzhalterVorname'].">";
		?>
	</div>
	<div class=" h-25 m-1 input-group d-flex align-items-center">
		<h5>Produkt Name englisch: &nbsp; </h5>
		<?php
		echo "<input class=\"form-control\" type=\"text\"  name=\"pe_name\" placeholder=".$langArray[$opt]['PlatzhalterVorname'].">";
		?>
	</div>
	<div class=" h-25 m-1 input-group d-flex align-items-center">
		<h5>Produkt Beschreibung deutsch: &nbsp; </h5>
		<?php
		echo "<input class=\"form-control\" type=\"text\"  name=\"pd_beschreibung\" placeholder=".$langArray[$opt]['PlatzhalterVorname'].">";
		?>
	</div>
	<div class=" h-25 m-1 input-group d-flex align-items-center">
		<h5>Produkt Beschreibung englisch: &nbsp; </h5>
		<?php
		echo "<input class=\"form-control\" type=\"text\"  name=\"pe_beschreibung\" placeholder=".$langArray[$opt]['PlatzhalterVorname'].">";
		?>
	</div>
	<div class=" h-25 m-1 input-group d-flex align-items-center">
		<h5>Produkt Preis: &nbsp; </h5>
		<?php
		echo "<input class=\"form-control\" type=\"text\"  name=\"p_preis\" placeholder=".$langArray[$opt]['PlatzhalterVorname'].">";
		?>
	</div>
	<div class=" h-25 m-1 input-group d-flex align-items-center">
		<h5>Produkt Bild: &nbsp; </h5>
		<?php
		echo "<input class=\"form-control\" type=\"text\"  name=\"pd_name\" placeholder=".$langArray[$opt]['PlatzhalterVorname'].">";
		?>
	</div>
	</form>
</div>
</div>