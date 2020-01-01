<?php
/**
 * Created by PhpStorm.
 * User: Hannah
 * Date: 29.12.2019
 * Time: 13:35
 */

namespace Model;


class WarenkorbMdl
{
    private $item_id;
    private $name_de;
    private $name_en;
    private $besch_de;
    private $besch_en;
    private $preis;
    private $dateiname;
    private $menge;

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
    public function getNameDe()
    {
        return $this->name_de;
    }

    /**
     * @param mixed $name_de
     */
    public function setNameDe($name_de): void
    {
        $this->name_de = $name_de;
    }

    /**
     * @return mixed
     */
    public function getNameEn()
    {
        return $this->name_en;
    }

    /**
     * @param mixed $name_en
     */
    public function setNameEn($name_en): void
    {
        $this->name_en = $name_en;
    }

    /**
     * @return mixed
     */
    public function getBeschDe()
    {
        return $this->besch_de;
    }

    /**
     * @param mixed $besch_de
     */
    public function setBeschDe($besch_de): void
    {
        $this->besch_de = $besch_de;
    }

    /**
     * @return mixed
     */
    public function getBeschEn()
    {
        return $this->besch_en;
    }

    /**
     * @param mixed $besch_en
     */
    public function setBeschEn($besch_en): void
    {
        $this->besch_en = $besch_en;
    }

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
    public function getDateiname()
    {
        return $this->dateiname;
    }

    /**
     * @param mixed $dateiname
     */
    public function setDateiname($dateiname): void
    {
        $this->dateiname = $dateiname;
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


}