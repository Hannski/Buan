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

    public function getBonus($userId)
    {


    }


    //uebersicht ueber Zahlungen und Boni+ PDF ausdruck Moeglichkeit
    public function overviewAction()
    {
        if ($this->isPost('seeWages')) {
            $dateCHunks = explode('-', $_POST['jahrMonat']);
            $jahr = $dateCHunks[0];
            $monat = $dateCHunks[1];
            $bestellDaten = new BestellungenMdl();
            //alle bestellungen in dem ausgewaehlten Zeitraum nach userID aus Session
            $orders = $bestellDaten->getBestellungen($monat, $jahr);
            //Userausgaben
            $ausgaben = 0;
            foreach ($orders as $order) {

                foreach ($order as $orderItems) {

                    $menge = $orderItems->getMenge();
                    $preis = $orderItems->getPreis();
                    //gesamtpreis Menge mal Produktpreis
                    $summeProdukt = $menge * $preis;
                    //auf gesamtzahlungen addieren
                    $ausgaben = $ausgaben + $summeProdukt;
                }
            }

            //Bonus fuer diesen Monat anhand der gesamtausgaben des Nutzers
        $bonus = $this->calcBonus($ausgaben);
            echo $bonus;

        }
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
        $this->getNav();
        echo $this->render('pages/user/rechnungen', array('wageMonths' => $wageMonths));

    }

    //Bonus ausrechnen
    public function calcBonus($ausgaben)
    {
        if ($ausgaben >3000) {
            return 1500;
        } elseif ($ausgaben >1000) {
            return 1000;
        } elseif ($ausgaben > 0) {
            return 500;
        }
            return 0;


    }


}