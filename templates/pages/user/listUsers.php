<div class="container">
	<div class="row">
		<table class="table">
			
			<?php
			
			foreach ($userArray as $key){
			$id = $key->getId();
	 	 	$username = $key->getUsername();
			$status = $key->getStatus();
		
			echo "<tr><td>$id</td></tr>";
			?>
		</table>
	</div>
</div>