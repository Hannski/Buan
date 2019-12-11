<?php
	function createCaptcha()
	{

$captcha_num = 'ABCDEFGHJKLMNOPQRSTUVWXYZ1234567890abcdefghijkmnopqrstuvwxyz';
$captcha_num = substr(str_shuffle($captcha_num), 0, 6);
$_SESSION["code"] = $captcha_num;
$font_size = 15;
$img_width = 120;
$img_height = 50;
header('Content-type: image/jpeg');
$image = imagecreate($img_width, $img_height); // create background image with dimensions
imagecolorallocate($image, 255, 255, 255); // set background color
$text_color = imagecolorallocate($image, 0, 0, 0); // set captcha text color
$font= dirname(__FILE__)."/font24.ttf";
imagettftext($image, $font_size, 0, 15, 30, $text_color,$font , $captcha_num);
imagejpeg($image);

	}
	createCaptcha();