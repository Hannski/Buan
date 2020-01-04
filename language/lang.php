<?php
require_once './countries/countries.php';
/*
Buttons
*/
//Navigationselemente:
$langArray[0]["language"] 			= "de";
$langArray[1]["language"] 			= "en";
//as admin Anmelden : Button beschriftung
$langArray[0]["loginAdmin"] 		="als Admin anmelden";
$langArray[1]["loginAdmin"] 		="login as admin";
//als user anmelden
$langArray[0]["loginUser"] 		    ="Anmelden";
$langArray[1]["loginUSer"] 		    ="Login";
$langArray[0]["pwForgot"] 		    ="Passwort vergessen";
$langArray[1]["pwForgot"] 		    ="Forgot Password";
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
$langArray[0]['captcha']			= "Captcha";
$langArray[1]['captcha']			= "Captcha";
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
$langArray[0]['submitUserdata']     = "Anmeldedaten aktualisieren";
$langArray[1]['submitUserdata']     = "Update Login Information";
$langArray[0]['submitUserAdress']   = "Adresse aktualisieren";
$langArray[1]['submitUserAdress']    = "Update Address Information";
$langArray[0]['myPasswordData']     = "Passwort &auml;ndern";
$langArray[1]['myPasswordData']     = "update password";


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
$langArray[0]["Pw"] 		        = "Passwort";
$langArray[1]["Pw"] 		        = "password";
$langArray[0]["PwRepeat"]           = "Passwort wiederholen";
$langArray[1]["PwRepeat"]           = "repeat password";
$langArray[0]["vorname"]            = "Vorname";
$langArray[1]["vorname"]            = "first&nbsp;name";
$langArray[0]["nachname"] 	        = "Nachname";
$langArray[1]["nachname"] 	        = "last&nbsp;name";
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


$langArray[0]['notPw']              = "Passw&ouml;rter stimmen nicht &uuml;berein";
$langArray[1]['notPw']              = "the passwords you entered do ot match";
$langArray[0]['emptyInput']         = "%s muss gegeben sein.";
$langArray[1]['emptyInput']         = "%s must be given.";
$langArray[0]['notCaptcha']         = "Der eingegebene Captcha stimmt nicht ueberein";
$langArray[1]['notCaptcha']         = "Captcha does not match";
$langArray[0]['noRegisterReq']      = "zurzeit keine Registrierunsanfragen";
$langArray[1]['noRegisterReq']      = "No register requests at this time";
$langArray[0]['emptyFields'] 		= "Alle Felder m&uuml;ssen ausgef&uuml;llt werden!";
$langArray[1]['emptyFields'] 		= "Fields cannot be empty!";
$langArray[0]['emptyPasswortNeu']   = "Neues Passwort muss ausgef&uuml;llt werden!";
$langArray[1]['emptyPasswortNeu']   = "new password cannot be empty!";
$langArray[0]['emptyPasswortMatch'] = "Passwort wiederholen muss ausgef&uuml;llt werden!";
$langArray[1]['emptyPasswortMatch'] = "Password repeat cannot be empty!";
$langArray[0]['emptyMsg']           = "Bitte geben Sie eine Beitrittsbegr&uuml;ndung an!";
$langArray[1]['emptyMsg']           = "Please leave the reason for your application. ";
$langArray[0]['noMatch']            = "Passw&ouml;rter stimmen nicht &uuml;berein";
$langArray[1]['noMatch']            = "the passwords you entered do ot match";
$langArray[0]['notCaptcha']         = "Der eingegebene Captcha stimmt nicht ueberein";
$langArray[1]['notCaptcha']         = "Der eingegebene Captcha stimmt nicht ueberein";
$langArray[0]['emptyPassword']      = "Passwort muss ausgef&uuml;llt werden!";
$langArray[1]['emptyPassword']      = "Password cannot be empty!";
$langArray[0]['emptyVorname']       = "Vorname musss  ausgef&uuml;llt werden!";
$langArray[1]['emptyVorname']       = "First Name cannot be empty!";
$langArray[0]['emptyNachname']      = "Nachname musss  ausgef&uuml;llt werden!";
$langArray[1]['emptyNachname']      = "Last Name cannot be empty!";
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
$langArray[1]['emptyLand']          = "Please choose a country";
$langArray[0]['emptyPasswortAlt']   = "Bitte best&auml;tigen Sie ihr altes Password";
$langArray[1]['emptyPasswortAlt']   = "Please confirm your old password";
$langArray[0]['pwLength']           = "Passwort muss zwischen 5 und 15 Zeichen enthalten";
$langArray[1]['pwLength']           = "Password must contain between 5 and 15 Characters";
$langArray[0]['nameTaken']          = "Username bereits vergeben";
$langArray[1]['nameTaken']          = "Username has already been taken";
$langArray[0]['pwNope']             = "eingegebenes Passwort stimmt nicht";
$langArray[1]['pwNope']             = "submitted password is wrong";
$langArray[0]['changeSuccess']      = "&Auml;nderungen wurden erfolgreich durchgef&uuml;hrt";
$langArray[1]['changeSuccess']      = "Changes made successfully";
$langArray[0]['changeNope']         = "Es gab einen unerwateten Fehler";
$langArray[1]['changeNope']         = "Sorry there was an error while processing your request";
$langArray[0]['noAddress']          = "Noch keine Adresse hinterlegt";
$langArray[1]['noAddress']          = "No Adress information on file";
$langArray[0]['emptyCart']          = "Noch keine Artikel im Warenkorb";
$langArray[1]['emptyCart']          = "No Items added to cart yet";
$langArray[0]['orderYes']           = "Ihre Bestellung wurde erfolgreich &uuml;bermittelt";
$langArray[1]['orderYes']           = "Your order has been placed";
$langArray[0]['productYes']         = "Das Produkt wurde erfolgreich &uuml;bermittelt";
$langArray[1]['productYes']         = "Product submitted successfully";
$langArray[0]['dbProblem']          = "Upps. Es gab wohl ein Problem mit der Datenbank.";
$langArray[1]['dbProblem']          = "OOPs. There seems to have been a problem with the databbase";
$langArray[0]['orderNope']          = "Ihre Bestellung wurde";
$langArray[1]['orderNope']          = "Your order";
$langArray[0]['tooNegative']        = "Werte f&uuml;r Mengenangaben d&uuml;rfen nicht negativ sein";
$langArray[1]['tooNegative']        = "Values for quantity inputs must not be negative";
$langArray[0]['emptyPd_name']       = "Bitte geben Sie einen deutschen Namen ein";
$langArray[1]['emptyPd_name']       = "Please enter a German title";
$langArray[0]['emptyPe_name']       = "Bitte geben Sie einen englischen Namen ein";
$langArray[1]['emptyPe_name']       = "Please enter an English title";
$langArray[0]['emptyP_preis']       = "Bitte machen Sie eine Preisangabe";
$langArray[1]['emptyP_preis']       = "Please enter a Price";
$langArray[0]['emptyMenge']         = "Fehlt: Angabe zum Lagerbestand";
$langArray[1]['emptyMenge']         = "Please enter Stock";
$langArray[0]['noDatei']            = "Bitte w&auml;hlen Sie eine Datei aus";
$langArray[1]['noDatei']            = "Please choose a File";
$langArray[0]['emptyPd_beschreibung']= "Bitte geben Sie eine deutsche Beschreibung ein";
$langArray[1]['emptyPd_beschreibung']= "Please enter a German description";
$langArray[0]['emptyPe_beschreibung']= "Bitte geben Sie eine englische Beschreibung ein";
$langArray[1]['emptyPe_beschreibung']= "Please enter an English description";
$langArray[0]['captchaNope']		= "Der eingegebene Captcha stimmt nicht &uuml;berein";
$langArray[1]['captchaNope']		= "The Captcha you entered does not match";
$langArray[0]['usernameNope']		= "Ein passender Username konnte nicht gefunden werden";
$langArray[1]['usernameNope']		= "The username you entered does not exist";



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




//Formulare
$langArray[0]['username']     		= "Username";
$langArray[1]['username']     		= "Username";
$langArray[0]['password']     		= "Passwort";
$langArray[1]['password']     		= "Password";
$langArray[0]['pwOld']     		    = "Mit altem Passwort best&auml;tigen";
$langArray[1]['pwOld']     		    = "Confirm with old Password";
$langArray[0]['pwNew']     		    = "neues Passwort";
$langArray[1]['pwNew']     		    = "New Password";
$langArray[0]['pwRepeatNew']        = "neues Passwort wiederholen";
$langArray[1]['pwRepeatNew']        = "reenter new Password";