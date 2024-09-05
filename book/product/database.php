<?php 

class Database{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'product';

    protected $connection;

    function connect (){
        $this->connection = new PDO("mysql:host =$this->host;dbname=$this->dbname", 'root', '');
        return $this->connection;
    }
}

