<div>
	<?php
	foreach ($produkteArray as $key)
	 {
			$id = $key->getId();
			$pDname = $key->getNameDe();
			$PEname = $key->getNameEn();
			$desD = $key->getBeschreibungDe();
			$desE = $key->getBeschreibungEn();
			$preis = $key->getPreis();
			$file = $key->getDateiname();
	echo $id;
	echo $pDname;
	echo "<img src=\"Assets/".$file."\" alt=\"haha\">";
	}
	
	 ?>

</div>