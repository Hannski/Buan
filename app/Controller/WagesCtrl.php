<?php


namespace Controller;

/*
 * Controller ist zustaendig fuer die Berrechnung aller Gehaelter und Boni
 * der angestellten Personen.
 * zu jedem Zeitpunkt kann Anhand der bestaetigten Mitgliedschaft. und der festgelegten
 * Gehaltssumme von 3000 Euro.
 * -Gehaelter werden in diesem Fall unabhaengig vom Sperrstatus ausgezahlt.
 * -Berrechnungen basieren auf der Annahme, dass ein Gehalt sich nicht aendert und
 *  rechtfertigen damit den Entschluss auf eine eigene Tabelle in der DB zu verzichten.
 * */

use Model\Resource\BestellungenMdl;
use Model\Resource\UserMdl;

class WagesCtrl extends AbstractController
{
    //monatliches Grundgehalt
    const MIN_WAGE = 3000;

    //uebersicht ueber Zahlungen und Boni+ PDF ausdruck Moeglichkeit
    public function overviewAction()
    {
        $user = new UserMdl();
        //erster Monat des EInstellungsverhaeltnisses
        $user = $user->getUserById($_SESSION['userId']);
        $firstMonth = $user->getAcceptiondate();
        $date = new \DateTimeImmutable($firstMonth);
        //formattieren nach schema "jahr-monat"
        $date->format("Y-m");
        //Datum und Zeit JETZT!
        $now = new \DateTimeImmutable();
        //Gehaltsmonate seit Einstellungsmonat berrechnen
        $wageMonths = array();
        while ($date <= $now) {
            //Jahre und MOnate ins Array schreiben:
            $wageMonths[] = $date;
            //einen Monat definieren
            $month = new \DateInterval("P1M");
            $date = $date->add($month);
        }
        //neueste Eintraege zuerst
        $wageMonths = array_reverse($wageMonths);

        if ($this->isPost('seeWages')) {
            $dateCHunks = explode('-', $_POST['jahrMonat']);
            $jahr = $dateCHunks[0];
            $monat = $dateCHunks[1];

        $ausgaben = $this->calcGehalt($jahr,$monat);
            //Bonus fuer diesen Monat anhand der gesamtausgaben des Nutzers
        $bonus = $this->calcBonus($ausgaben);


            $this->getNav();
            echo $this->render('pages/user/rechnungen', array('wageMonths' => $wageMonths));

            //diagrammAction erstellt diagramm.
            $params=array();
            $params['jahr'] = $jahr;
            $params['monat'] = $monat;
            $params['bonus'] = $bonus;
            echo $this->render('pages/user/diagrams',$params);
        }
        else{

            $this->getNav();
            echo $this->render('pages/user/rechnungen', array('wageMonths' => $wageMonths));
        }

    }

    public function diagrammAction(): void
    {
        $jahr = $_GET['jahr'];
        $monat = $_GET['monat'];
        $diagrammBreite = 500;
        $diagrammHoehe = 50;

        $image = imagecreatetruecolor($diagrammBreite, $diagrammHoehe);

        $white = imagecolorallocate($image, 255, 255, 255);
        $red = imagecolorallocate($image, 255, 0, 0);
        $green = imagecolorallocate($image, 0, 255, 0);

        imagefill($image, 0, 0, $white);

        $wage = $this->calcGehalt($jahr, $monat);
        if($wage) {
            $bonus = $this->calcBonus($wage);

        }else{
            $wage=3000;
            $bonus=0;
        }
        //gesmatbreite diagramm: 300 px : anteile der Farben berrechnen:
        $gesamtAuszahlung = $wage + $bonus;

        $breiteGehalt = $diagrammBreite / $gesamtAuszahlung * $wage;
        $breiteBonus = $diagrammBreite / $gesamtAuszahlung * $bonus;

        imagefilledrectangle($image, 0, 0, $breiteGehalt, $diagrammHoehe, $red);
        imagefilledrectangle($image, $breiteGehalt + 1, 0, $breiteGehalt + $breiteBonus, $diagrammHoehe, $green);

        imagettftext($image, 14, 0, 20, 20, $white, 'app/includes/font24.ttf', 'Basisgehalt: '.$wage);
        imagettftext($image, 14, 0, $breiteGehalt + 20, 20, $white, 'app/includes/font24.ttf', 'Bonus: '.$bonus);

        header('Content-type: image/png');

        imagepng($image);
        imagedestroy($image);

    }


    public function gehaltsabrechnungAction()
    {
        $ausgaben = $this->calcGehalt($_GET['jahr'],$_GET['monat']);
        $bonus = $this->calcBonus($ausgaben);
        require_once('./fpdf/fpdf.php');
        $pdf = new \FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,'Hello World!'.$_GET['monat'].$_GET['jahr']);
        $pdf->Output();

    }
    //Bonus ausrechnen
    protected function calcBonus($umsatz)
    {
        if ($umsatz >3000) {
            return 1500;
        } elseif ($umsatz >1000) {
            return 1000;
        } elseif ($umsatz > 0) {
            return 500;
        }
            return 0;
    }

    protected function calcGehalt(int $jahr, int $monat): int
    {
        $bestellDaten = new BestellungenMdl();
        //alle bestellungen in dem ausgewaehlten Zeitraum nach userID aus Session
        $orders = $bestellDaten->getBestellungen($monat, $jahr);
        //Userausgaben
        $gehalt = 0;

        foreach ($orders as $order) {
            foreach ($order as $orderItems) {
                $menge = $orderItems->getMenge();
                $preis = $orderItems->getPreis();

                //gesamtpreis Menge mal Produktpreis
                $summeProdukt = $menge * $preis;

                //auf gesamtzahlungen addieren
                $gehalt = $gehalt + $summeProdukt;
            }
        }

        return $gehalt;
    }
}