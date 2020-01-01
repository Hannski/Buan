<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 21.12.2019
 * Time: 12:25
 * dieser Controller regelt was bei Aufrufen der index.php angezeigt und ausgewertet wird.
 */

namespace Controller;
use App;
use View\View;
class DefaultController extends AbstractController
{
    public function defaultAction():void
    {
        echo $this->render('seitenkomponenten/header');
        echo $this->render('pages/seitenkomponenten/nav');
        echo $this->render('pages/user/enterSite');
        echo $this->render('seitenkomponenten/footer');

    }


}