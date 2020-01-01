<div class="container">
	<div class="row">
		<table class="table">
			
			<?php

			foreach ($userArray as $key){
			$id = $key->getId();
	 	 	$username = $key->getUsername();
			$status = $key->getStatus();
			$msg = $key->getAppMsg();
			
			echo "<tr>
			<td>Id:</td><td class =\"border-right\">".$id."</td>
			<td>Username:</td><td class =\"border-right\">".$username."</td>";
			echo "<td>".$msg."</td>";
			?>

			<td>authorisieren? </td>
			<td>
				<form method="POST">
				<input type="checkbox" name="status" value="unlock">
				<input type="hidden" name = "id" value="<?php echo $id ?>">
				<button name="auth" class="btn btn-sm my-1 my-sm-0 btn-outline-secondary">check</button>
				</form>
			</td>
			</tr>
			<?php
			}
			?>
		</table>
	</div>
</div>