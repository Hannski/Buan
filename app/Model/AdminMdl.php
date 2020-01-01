<?php
namespace Model;
class AdminMdl
{
private $a_id;
private $a_nname;
private $a_vorname;
private $a_pw;
private $status;
private $super;


    /**
     * @return int
     */
    public function getAId()
    {
        return $this->a_id;
    }

    /**
     * @param int $p_id
     */
    public function setAId($a_id)
    {
        $this->a_id = $a_id;
    }

    /**
     * @return string
     */
    public function getANname()
    {
        return $this->a_nname;
    }

    /**
     * @param string $p_name
     */
    public function setANname($a_nname)
    {
        $this->a_nname = $a_nname;
    }

     /**
     * @return string
     */
    public function getAVorname()
    {
        return $this->a_vorname;
    }

    /**
     * @param string $p_name
     */
    public function setAVorname($a_vorname)
    {
        $this->a_vorname = $a_vorname;
    }


    /**
     * @return int
     */
    public function getAPw()
    {
        return $this->a_pw;
    }

    /**
     * @param int $p_id
     */
    public function setAPw($a_pw)
    {
        $this->a_pw = $a_pw;
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

    /**
     * @return mixed
     */
    public function getSuper()
    {
        return $this->super;
    }

    /**
     * @param mixed $super
     *
     * @return self
     */
    public function setSuper($super)
    {
        $this->super = $super;

        return $this;
    }
}