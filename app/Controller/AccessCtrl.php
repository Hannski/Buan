<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 06.01.2020
 * Time: 20:51
 */

namespace Controller;


class AccessCtrl extends AbstractCtrl
{
    public function deniedAction()
    {
        $this->getNav();
        echo $this->render('pages/alerts/accessDenied');
        $this->getFooter();
    }
}