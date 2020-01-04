<?php
//falls keine Session gestartet wurde:
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
	/*diese datei wird als quelle fuer ein <img> in der Datei: root/alerts/pages/user-login aufgerufen*/

//Zugelassene Zeichen: Der Einfachheit halber: nur grosse Buchstaben!
$captcha_num = 'ABCDEFGHJKLMNPQRSTUWXYZ23456789';
/*substr: Gibt einen Teil eines Strings zurück, str_shuffle: mischt Zeichen im String nach dem Zufallsprinzip*/
$captcha_num = substr(str_shuffle($captcha_num), 0, 1);

//Captcha für überprüfung in session speichern.
$_SESSION['captcha'] = $captcha_num;
// Zeichengroesse
$font_size = 15;
//Breite und Hoehe des generierten Bildes
$img_width = 120;
$img_height = 50;
//Typ festlegen
header('Content-type: image/jpeg');
 // Hintergrundbild mit hoehe und breite generieren
$image = imagecreate($img_width, $img_height);
//Hintergrundfarbe festlegen
imagecolorallocate($image, 255, 255, 255);
// festlegen: captcha-text-farbe
$text_color = imagecolorallocate($image, 79, 58, 0); 
// Pfad zum benutzerdefinierten Font : .ttf-Datei
$font= dirname(__FILE__)."/font24.ttf";
/*imagettftext — Schreibe Text ins Bild unter Verwendung von True-Type-Schriftarten*/
/*reihenfolge: hintergrundbild , schriftgroesse , rotation , x-achse , y-achse , schriftfarbe , $font , captchatext*/
imagettftext($image, $font_size, 0, 15, 30, $text_color,$font , $captcha_num);
//Captcha für überprüfung in session speichern.

//imagejpeg — Gibt das Bild im Browser oder einer Datei aus.
imagejpeg($image);



//Funktion ausfuehren: Captcha-jpeg wird erzeugt und ausgegeben

