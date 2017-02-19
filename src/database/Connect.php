<?php

namespace App\Database;

class Connect {

    private $host;
    private $dbname;
    private $login;
    private $password;

    public function __construct($dbname, $host = 'localhost', $login = 'root', $password = '')
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->login = $login;
        $this->password = $password;
    }

    public function connection () {
        try {
            $database = new \PDO("mysql:host=$this->host;dbname=$this->dbname", "$this->login","$this->password");

            return $database;
        }
        catch (\Exception $exception) {
            $exception->getMessage();
        }
    }

}