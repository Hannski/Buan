<?php
 // CAPTCHA-Funktion 
	  function generateCaptcha() 
	 { 
	 	$md5_hash = md5(rand(0,999));
		$captcha = substr($md5_hash,15,5);

		$_SESSION['captcha']  =$captcha;

		//width,height
		$image = imagecreatetruecolor(20, 15);

		//Farben

		$blau = imagecolorallocate($image,68, 101, 155);
		$rot =  imagecolorallocate($image,173, 53, 111);
		$gelb = imagecolorallocate($image,224, 177, 49);
		$lila = imagecolorallocate($image,107, 29, 186);
		$grau = imagecolorallocate($image,77, 76, 79);
		$ruby = imagecolorallocate($image,217, 144, 221);
		$white = imagecolorallocate($image,255,255,255);

		//Hintergrund
		imagefill($image,0,0,$white);
		//Text einfügen
				imagettftext($image, 20, 15, 20, 40, $blau, $captcha);
				//Typ festlegen
				header("Content-Type: image/jpeg");
				//zu JPEG umwandeln
				imagejpeg($image);
				// Cache leeren
				imagedestroy($image);
		
	 } 
?>
<div class="login h-50 d-flex-flex-col row m-1">
<form method="POST" class="form-signin bg-light container p-4 d-flex-flex-col justify-content-center">
	
	<span><h1><?php echo $langArray[0]["adminSignin"]?></h1></span>
	<div class=" h-25 input-group input-group-lg mr-sm-2">
		<?php
		echo "<input class=\"form-control\" type=\"text\"  name=\"name\" placeholder=".$langArray[$opt]['PlatzhalterVorname'].">";
		?>
	</div>
	<div class=" h-25 input-group input-group-lg mr-sm-2">
		<?php
		echo "<input class=\"form-control\" type=\"text\"  name=\"nachname\" placeholder=".$langArray[$opt]['PlatzhalterNname'].">";
		?>
	</div>

	<div class=" h-25 input-group input-group-lg mr-sm-2">
		<?php
		echo "<input class=\"form-control\" type=\"password\"  name=\"password\" placeholder=".$langArray[$opt]['PlatzhalterPw'].">";
		?>
	</div>
	<div class=" h-25 input-group input-group-lg mr-sm-2">
		<?php
	function  create_image()
    {
        $image = imagecreatetruecolor(200, 50);
        return imagepng($image, "image.png");
    }
		echo "<input class=\"form-control\" type=\"text\"  name=\"captcha\" placeholder=".$langArray[$opt]['PlatzhalterPw'].">";
		?><br>
<div class="h-25 w-25"><img src=""<?php echo create_image(); ?>"" alt="hh"></div>
		
	</div>

	<button type="submit" class=" m-2 btn bnt-lg btn-outline-success my-2 my-sm-0" name="a_login">
		<?php echo $langArray[0]["loginButton"]?>
			
	</button>
	<!-- Captcha -->
</form>
</div>