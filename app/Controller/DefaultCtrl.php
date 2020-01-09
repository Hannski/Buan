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

class DefaultController extends AbstractController
{
    public function defaultAction():void
    {
        $this->guestAccessOnly('admin','home-login');
        echo $this->render('seitenkomponenten/header');
        echo $this->render('pages/user/UserNav');
        echo $this->render('pages/user/enterSite');
        echo $this->render('seitenkomponenten/footer');

    }

}