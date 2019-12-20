<?php
namespace Model;
class UserMdl
{
	private $id=0;
	private $username="";
	private $pwmd5="";
	private $acceptiondate="";
	private $status="";
	private $temppw="";
    private $appMsg ="";
	


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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     *
     * @return self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPwmd5()
    {
        return $this->pwmd5;
    }

    /**
     * @param mixed $pwmd5
     *
     * @return self
     */
    public function setPwmd5($pwmd5)
    {
        $this->pwmd5 = $pwmd5;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAcceptiondate()
    {
        return $this->acceptiondate;
    }

    /**
     * @param mixed $acceptiondate
     *
     * @return self
     */
    public function setAcceptiondate($acceptiondate)
    {
        $this->acceptiondate = $acceptiondate;

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

    /**
     * @return mixed
     */
    public function getTemppw()
    {
        return $this->temppw;
    }

    /**
     * @param mixed $temppw
     *
     * @return self
     */
    public function setTemppw($temppw)
    {
        $this->temppw = $temppw;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAppMsg()
    {
        return $this->appMsg;
    }

    /**
     * @param mixed $appMsg
     *
     * @return self
     */
    public function setAppMsg($appMsg)
    {
        $this->appMsg = $appMsg;

        return $this;
    }
}