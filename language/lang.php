<?php
/*
Buttons
*/
$langArray[0]["language"] 			= "de";
$langArray[1]["language"] 			= "en";

//as admin Anmelden : Button beschriftung
 $langArray[0]["loginButton"] 		="als Admin anmelden";
 $langArray[1]["loginButton"] 		="login as admin";

//Styleauswahl Navigationsleiste
$langArray[0]["styleDark"]			= "Nachtmodus";
$langArray[1]["styleDark"] 			= "dark mode ";

$langArray[0]["styleLight"] 		= "Tagmodus";
$langArray[1]["styleLight"] 		= "light mode";

// Button zur weiterleitung im Footer in den Anmeldebereich des Administtrators
//siehe /templates/seitenkomponenten/footer.php
$langArray[0]['redirectAdminLogin'] = "als Admin anmelden";
$langArray[1]['redirectAdminLogin'] = "login as admin";

// Abmelden Button
$langArray[0]['logout']				= "Abmelden";
$langArray[1]['logout']				= "Logout";

//Buttons Adminseite
$langArray[0]['p_add']				= "Produkte Hinzuf&uuml;gen";
$langArray[1]['p_add']				= "add products";
$langArray[0]['p_edit']				= "produkteverwaltung";
$langArray[1]['p_edit']				= "producteditor";
$langArray[0]['u_edit']				= "Benutzer verwalten";
$langArray[1]['u_edit']				= "User administration";
$langArray[0]['pd_name']			= "Produktname Deutsch";
$langArray[1]['pd_name']			= "product name German";
$langArray[0]['pe_name']			= "Produktname Englisch";
$langArray[1]['pe_name']			= "product name English";
$langArray[0]['pd_des']				= "Beschreibung Deutsch";
$langArray[1]['pd_des']				= "Description German";
$langArray[0]['pe_des']				= "Beschreibung Englisch";
$langArray[1]['pe_des']				= "Description English";
$langArray[0]['produkt']			= "Produkt ";
$langArray[1]['produkt']			= "product ";
$langArray[0]['datei'] 				= "Datei ausw&auml;hlen";
$langArray[1]['datei'] 				= "choose file";
$langArray[0]['btn_p_add']			= "Produkt einstellen";
$langArray[1]['btn_p_add']			= "Submit Product";
//Produktinformationen Aktualisieren
$langArray[0]['aendern']			= "aktualisieren";
$langArray[1]['aendern']			= "update";


//Ende Buttons 

//Links
//Produkte Einstellen
$langArray[0]['p_einstellen'] 		= "neues-produkt";
$langArray[1]['p_einstellen'] 		= "new-product";

//
 
//text

/*Admin Login Formular*/
$langArray[0]["adminSignin"] 		= "wilkommen zur&uuml;ck";
$langArray[1]["adminSignin"] 		= "Welcome back";

//Formular PLatzhalter
//Anmeldevorgang
$langArray[0]["PlatzhalterPw"] 		= "Passwort";
$langArray[1]["PlatzhalterPw"] 		= "password";
$langArray[0]["PlatzhalterVorname"] = "Vorname";
$langArray[1]["PlatzhalterVorname"] = "first&nbsp;name";
$langArray[0]["PlatzhalterNname"] 	= "Nachname";
$langArray[1]["PlatzhalterNname"] 	= "last&nbsp;name";
//Produkte hinzufuegen
$langArray[0]['p_add_label']		= "Produkte hinzuf&uuml;gen";
$langArray[1]['p_add_label']		= "Add Products";
$langArray[0]['Platzh_P_preis'] 	= "Preis";
$langArray[1]['Platzh_P_preis'] 	= "price";
$langArray[0]['Platzh_P_beschr'] 	= "beschreibung";
$langArray[1]['Platzh_P_beschr'] 	= "description";
$langArray[0]['Platzh_P_Name'] 		= "name";
$langArray[1]['Platzh_P_Name'] 		= "name";

//Fehlerausgaben
//Anmeldefehler info an den user
//nicht alle Felder augefuellt:
$langArray[0]['emptyFields'] 		= "Alle Felder m&uuml;ssen ausgef&uuml;llt werden!";
$langArray[1]['emptyFields'] 		= "Fields cannot be empty!";
 // Username Falsch oder Passwort falsch
$langArray[0]['nameNot'] 			="Passwort oder Username falsch";
$langArray[1]['nameNot'] 			="Password or Username wrong";
//Dopplung in der Fehlerausagbe um Hinweise auf Sachverhalte in der
//Datenbank zu vermeiden "Passwort Falsch" == Hinweis, dass Username existiert und andersherum
$langArray[0]['pwNot'] 				="Passwort oder Username falsch";
$langArray[1]['pwNot'] 				="Password or username wrong";

//Produkteinstellungsformular
//Produktnamen
$langArray[0]['emptyPname']  		= "Produktnamen m&uuml;ssen ausgef&uuml;llt werden";
$langArray[1]['emptyPname']  		= "Productnames cannot be empty";
//Produktbeschreibungen
$langArray[0]['emptyDes']  			= "Produktbeschreibungen d&uuml;rfen nicht leer sein";
$langArray[1]['emptyDes']  			= "Product descriptios cannot be empty";
//Produktpreis 0 oder -Wert
$langArray[0]['preiszuklein']  		= "Preis darf nicht Null oder weniger sein";
$langArray[1]['preiszuklein']  		= "Price cannot be zero or less";
//Dateityp nicht erlaub
$langArray[0]['dateityp']     		= "erlaubte Dateitypen : .jpg, .png";
$langArray[1]['dateityp']     		= "permittet filetypes : .jpg, .png";