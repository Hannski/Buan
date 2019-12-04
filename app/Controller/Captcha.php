	<?php
	namespace Controller;
	class Captcha
	{
	 
	 // CAPTCHA-Funktion 
	 public function generateCaptcha() 
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
		echo $font = "/app/fonts/font24.ttf";
		//Text einfügen
				imagettftext($image, 20, 15, 20, 40, $blau, $font, $captcha);
				//Typ festlegen
				header("Content-Type: image/jpeg");
				//zu JPEG umwandeln
				imagejpeg($image);
				// Cache leeren
				imagedestroy($image);
		
	 } 
	 


	}