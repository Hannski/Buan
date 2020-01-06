<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 31.12.2019
 * Time: 13:08
 */

namespace Model;


class BestellungenMdl
{
private $datum;
private $item_id;
private $menge;
private $order_id;
private $status;
private $year;
private $month;
private $pNameD;
private $pNameE;
private $preis;




    /**
     * @return mixed
     */
    public function getPreis()
    {
        return $this->preis;
    }

    /**
     * @param mixed $preis
     */
    public function setPreis($preis): void
    {
        $this->preis = $preis;
    }



    /**
     * @return mixed
     */
    public function getPNameD()
    {
        return $this->pNameD;
    }

    /**
     * @param mixed $pNameD
     */
    public function setPNameD($pNameD): void
    {
        $this->pNameD = $pNameD;
    }

    /**
     * @return mixed
     */
    public function getPNameE()
    {
        return $this->pNameE;
    }

    /**
     * @param mixed $pNameE
     */
    public function setPNameE($pNameE): void
    {
        $this->pNameE = $pNameE;
    }




    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year): void
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @param mixed $month
     */
    public function setMonth($month): void
    {
        $this->month = $month;
    }


    /**
     * @return mixed
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * @param mixed $datum
     */
    public function setDatum($datum): void
    {
        $this->datum = $datum;
    }

    /**
     * @return mixed
     */
    public function getItemId()
    {
        return $this->item_id;
    }

    /**
     * @param mixed $item_id
     */
    public function setItemId($item_id): void
    {
        $this->item_id = $item_id;
    }

    /**
     * @return mixed
     */
    public function getMenge()
    {
        return $this->menge;
    }

    /**
     * @param mixed $menge
     */
    public function setMenge($menge): void
    {
        $this->menge = $menge;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * @param mixed $order_id
     */
    public function setOrderId($order_id): void
    {
        $this->order_id = $order_id;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }


}