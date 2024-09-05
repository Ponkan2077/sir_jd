<?php 

class Database{
    private $host = 'localhost:8080';
    private $username = 'root';
    private $password = '';
    private $dbname = 'book';

    protected $connection;

    function connect (){
        $this->connection = new PDO("mysql:host =$this->host;dbname=$this->dbname", 'root', '');
        return $this->connection;
    }
}

