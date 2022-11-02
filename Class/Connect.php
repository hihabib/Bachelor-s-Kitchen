<?php

namespace kitchen;
use PDO, kitchen\User;
session_start();
class Connect {
    public PDO $pdo;
    protected string $dbname;
    protected string $table_name;

    public function __construct() {
        $this -> dbname = Config::$dbname;
        $this -> table_name = Config::$table_name;
        $this -> pdo = new PDO("mysql:host=localhost;dbname=$this->dbname", "root", "root");
        $this->pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}