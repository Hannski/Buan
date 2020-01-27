<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 21.12.2019
 * Time: 12:25
 * Default Controller: rendert Template mit Anmeldungsfunktion und Registrierungsfunktion.
 */

namespace Controller;
use App;
use View\View;

class DefaultCtrl extends AbstractCtrl
{
    public function defaultAction():void
    {
        echo $this->render('seitenkomponenten/header');
        echo $this->render('seitenKomponenten/navigation');
        echo $this->render('pages/user/enterSite');
       $this->getFooter('guest','none');
    }

}