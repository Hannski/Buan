<div class="container ">
<div class="row d-flex justify-content-center">
	<div class="d-button border m-1 rounded col-md-3 col-sm-12 col-lg-3"> 
		<button class="btn btn-sm btn-outline my-1 my-sm-0" name="dashboard" value="add_p">
		<?php	echo "<a href=".$langArray[$opt]['p_einstellen'].">"; ?>
		<?php echo $langArray[$opt]['p_einstellen']; ?></a>
	    </button>
	</div>
		

	<form action="" method="POST"class="border d-button rounded m-1 col-md-3 col-sm-12 col-lg-3"><button class="btn btn-sm btn-outline my-1 my-sm-0" name="dashboard" value="change_p" ><?php echo $langArray[$opt]['p_edit']; ?></button></form>

	<form action ="" method="POST" class="border d-button rounded m-1 col-md-3 col-sm-12 col-lg-3"><button class="btn btn-sm btn-outline my-1 my-sm-0" name="dashboard" value="change_u"><?php echo $langArray[$opt]['u_edit']; ?></button></form>
</div>
</div>