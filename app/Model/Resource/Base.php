<?php
namespace Model\Resource;

class Base
{
	 public function connect()
    {
        $datenquelle = "mysql:host = localhost; dbname=eckhardt;";
        return new \PDO($datenquelle,"root","");
    }
}
