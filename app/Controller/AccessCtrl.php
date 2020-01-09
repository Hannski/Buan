<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 06.01.2020
 * Time: 20:51
 */

namespace Controller;


class Access extends AbstractCtrl
{
    public function deniedAction()
    {
        echo "hi";
        $this->getNav();
        echo $this->render('pages/alerts/404');
        $this->getFooter();
    }
}