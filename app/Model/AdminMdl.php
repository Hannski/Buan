<?php
namespace Model;
class AdminMdl
{
private $a_id = 0;
private $a_nname = "";
private $a_vorname ="";


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
        $this->p_id = $a_id;
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


}