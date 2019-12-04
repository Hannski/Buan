<?php
namespace Model;
class CartMdl
{
public $user_id = "";
public $produkt_id = "";
public $menge = "";

   /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     *
     * @return self
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProduktId()
    {
        return $this->produkt_id;
    }

    /**
     * @param mixed $produkt_id
     *
     * @return self
     */
    public function setProduktId($produkt_id)
    {
        $this->produkt_id = $produkt_id;

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
}