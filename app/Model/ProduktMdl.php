<?php
namespace Model;
class ProduktMdl
{
private $id;
private $name_de;
private $name_en;
private $beschreibung_de;
private $beschreibung_en;
private $preis;
private $dateiname;
private $dateipfad;
private $menge;
private $status;

//setters und getters generiert per SublimeText3 plugin "PHP getters and Setters: https://github.com/francodacosta/sublime-php-getters-setters"
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     *
     * @return self
     */
    public function setNameDe($name_de)
    {
        $this->name_de = $name_de;

        return $this;
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
     *
     * @return self
     */
    public function setNameEn($name_en)
    {
        $this->name_en = $name_en;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBeschreibungDe()
    {
        return $this->beschreibung_de;
    }

    /**
     * @param mixed $beschreibung_de
     *
     * @return self
     */
    public function setBeschreibungDe($beschreibung_de)
    {
        $this->beschreibung_de = $beschreibung_de;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBeschreibungEn()
    {
        return $this->beschreibung_en;
    }

    /**
     * @param mixed $beschreibung_en
     *
     * @return self
     */
    public function setBeschreibungEn($beschreibung_en)
    {
        $this->beschreibung_en = $beschreibung_en;

        return $this;
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
     *
     * @return self
     */
    public function setPreis($preis)
    {
        $this->preis = $preis;

        return $this;
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
     *
     * @return self
     */
    public function setDateiname($dateiname)
    {
        $this->dateiname = $dateiname;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateipfad()
    {
        return $this->dateipfad;
    }

    /**
     * @param mixed $dateipfad
     *
     * @return self
     */
    public function setDateipfad($dateipfad)
    {
        $this->dateipfad = $dateipfad;

        return $this;
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
     *
     * @return self
     */
    public function setMenge($menge)
    {
        $this->menge = $menge;

        return $this;
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
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
}