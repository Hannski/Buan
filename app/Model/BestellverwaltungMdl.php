<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 06.01.2020
 * Time: 22:09
 */

namespace Model;


class BestellverwaltungMdl
{
    private $month;
    private $year;

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



}