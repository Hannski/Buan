<?php
require_once './countries/countries.php';
/*
Buttons
*/
//Navigationselemente:
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
//siehe /alerts/seitenkomponenten/footer.php
$langArray[0]['redirectAdminLogin'] = "als Admin anmelden";
$langArray[1]['redirectAdminLogin'] = "login as admin";
// Abmelden Button
$langArray[0]['logout']				= "Abmelden";
$langArray[1]['logout']				= "Logout";
$langArray[0]['cart']				= "Einkaufswagen";
$langArray[1]['cart']				= "Cart";
$langArray[0]['myOrders']           = "Meine Bestellungen";
$langArray[1]['myOrders']           = "My Orders";
$langArray[0]['myUserData']         = "Meine Nutzerdaten";
$langArray[1]['myUserData']         = "My Userdata";
$langArray[0]['myLoginData']        = "Meine Anmeldedaten";
$langArray[1]['myLoginData']        = "My login information";
$langArray[0]['myAdressData']       = "Meine Adressdaten";
$langArray[1]['myAdressData']       = "My adress information";
$langArray[0]['myPayData']          = "Meine Rechnungen";
$langArray[1]['myPayData']          = "My receipts";

//Buttons Warenkorb
$langArray[0]['adressChange']     	= "Informationen &auml;ndern";
$langArray[1]['adressChange']     	= "Edit Information";
$langArray[0]['placeOrder']     	= "Bestellen";
$langArray[1]['placeOrder']     	= "Place Order";

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
$langArray[0]['preis']			    = "Preis";
$langArray[1]['preis']			    = "Price";
//Produktinformationen Aktualisieren
$langArray[0]['aendern']			= "aktualisieren";
$langArray[1]['aendern']			= "update";
//Nutzerregistrierung
$langArray[0]["submitRegister"]		= "Antrag absenden";
$langArray[1]["submitRegister"]		= "submit Application";
//Administrator hinzufuegen
$langArray[0]["addAdmin"]			= "Admin bestaetigen";
$langArray[1]["addAdmin"]			= "confirm admin";
//Ende Buttons
//Links
//Produkte Einstellen
$langArray[0]['p_einstellen'] 		= "neues-produkt";
$langArray[1]['p_einstellen'] 		= "new-product";
$langArray[0]['submitAdress'] 		= "Adresse best&auml;tigen";
$langArray[1]['submitAdress'] 		= "Submit Adress";


//texte
//Registrierungsformular für neue Nutzer:
$langArray[0]["register"] 			= "Mitgliedskonto beantragen";
$langArray[1]["register"] 			= "Apply for Membership";
/*Admin Login Formular*/
$langArray[0]["adminSignin"] 		= "wilkommen zur&uuml;ck";
$langArray[1]["adminSignin"] 		= "Welcome back";
//Formular PLatzhalter
//Bestellungen
$langArray[0]['monatJahr']          = 'Jahr und Monat ausw&aauml;hlen';
$langArray[1]['monatJahr']          = 'Choose year and month';
//Anmeldevorgang
$langArray[0]["PlatzhalterPw"] 		= "Passwort";
$langArray[1]["PlatzhalterPw"] 		= "password";
$langArray[0]["PlatzhalterPwRepeat"]= "Passwort wiederholen";
$langArray[1]["PlatzhalterPwRepeat"]= "repeat password";
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
//Amdinbereich: Amdinistratoren bearbeiten
$langArray[0]['aktiv'] 		= "aktiv";
$langArray[1]['aktiv'] 		= "active";
$langArray[0]['gesperrt'] 		= "gesperrt";
$langArray[1]['gesperrt'] 		= "locked";
//Fehlerausgaben
//Etwas funktioniert absolut nicht
$langArray[0]['nope'] 		= "Upps!. Hier ist leider etwas schief gelaufen";
$langArray[1]['nope'] 		= "Oops! Something went terribly wrong!";
//Anmeldefehler info an den user
//nicht alle Felder augefuellt:
$langArray[0]['emptyFields'] 		= "Alle Felder m&uuml;ssen ausgef&uuml;llt werden!";
$langArray[1]['emptyFields'] 		= "Fields cannot be empty!";
$langArray[0]['emptyPassword1']     = "Passwort 1 muss ausgef&uuml;llt werden!";
$langArray[1]['emptyPassword1']      = "Password 1 cannot be empty!";
$langArray[0]['emptyPassword2']     = "Passwort 2 muss ausgef&uuml;llt werden!";
$langArray[1]['emptyPassword2']     = "Password 2 cannot be empty!";
$langArray[0]['emptyMsg']           = "Bitte geben Sie eine Beitrittsbegr&uuml;ndung an!";
$langArray[1]['emptyMsg']           = "Please leave the reason for your application. ";
$langArray[0]['noMatch']            = "Passw&ouml;rter stimmen nicht &uuml;berein";
$langArray[1]['noMatch']            = "the passwords you entered do ot match";
$langArray[0]['notCaptcha']         = "Der eingegebene Captcha stimmt nicht ueberein";
$langArray[1]['notCaptcha']         = "Der eingegebene Captcha stimmt nicht ueberein";
$langArray[0]['emptyPassword']      = "Passwort muss ausgef&uuml;llt werden!";
$langArray[1]['emptyPassword']      = "Password cannot be empty!";
$langArray[0]['emptyUsername']      = "Username muss ausgef&uuml;llt werden!";
$langArray[1]['emptyUsername']      = "Username cannot be empty!";
$langArray[0]['emptyCaptcha']       = "Captcha muss ausgef&uuml;llt werden!";
$langArray[1]['emptyCaptcha']       = "Captcha cannot be empty!";
$langArray[0]['emptyOrt']           = "Ort muss ausgef&uuml;llt werden!";
$langArray[1]['emptyOrt']           = "City cannot be empty!";
$langArray[0]['emptyStrasse']       = "Stra&szlig;e muss ausgef&uuml;llt werden";
$langArray[1]['emptyStrasse']       = "Street   cannot be empty!";
$langArray[0]['emptyNummer']        = "Hausnummer muss ausgef&uuml;llt werden";
$langArray[1]['emptyNummer']        = "Number cannot be empty!";
$langArray[0]['emptyPlz']           = "Postleitzahl muss ausgef&uuml;llt werden";
$langArray[1]['emptyPlz']           = "Postal code cannot be empty!";
$langArray[0]['emptyLand']          = "Bitte geben Sie das Land mit an";
$langArray[1]['emptyLand']           = "Please choose a country";

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
//Adminlogin
$langArray[0]['locked']     		= "Ihr Konto wurde eventuell  gesperrt, bitte wenden Sie sich an der Seitenadministrator.";
$langArray[1]['locked']     		= "Your account may have been locked, please contact the site administrator.";
//Warenkorb

//text
$langArray[0]['deliverInfo']     	= "Lieferdetails: ";
$langArray[1]['deliverInfo']     	= "Delivery Information: ";
$langArray[0]['subTotal']     	    = "Gesamtbetrag: ";
$langArray[1]['subTotal']     	    = "Subtotal: ";
$langArray[0]['allOk']              = 'Alles richtig?';
$langArray[1]['allOk']              = 'Everything correct?';
//Adressfelder
$langArray[0]['adressHead']     	= "Adressdaten";
$langArray[1]['adressHead']     	= "Adress Information";
$langArray[0]['street']     		= "Stra&szlig;e";
$langArray[1]['street']     		= "Street";
$langArray[0]['number']     		= "Nr.";
$langArray[1]['number']     		= "Nr.";
$langArray[0]['plz']     		    = "Plz.";
$langArray[1]['plz']     		    = "Postal Code";
$langArray[0]['ort']     		    = "Ort";
$langArray[1]['ort']     		    = "City";
$langArray[0]['land']     		    = "Land";
$langArray[1]['land']     		    = "Country";
//PLatzhalter
$langArray[0]['pickLand']     		= "Land w&auml;hlen";
$langArray[1]['pickLand']     		= "Choose Country";




