<?php

namespace App\Component;

class Db {

    protected $connection;

    public function __construct($host, $dbname, $user, $password)
    {
        $this->connection = new \PDO("mysql:dbname=$dbname;host=$host", $user, $password);
    }

    public function getConnection()
    {
        return $this->connection;
    }
}