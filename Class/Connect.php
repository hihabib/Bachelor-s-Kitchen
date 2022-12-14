<?php

namespace kitchen;
use PDO, kitchen\User;
session_start();
class Connect {
    public PDO $pdo;
    protected string $dbname;
    protected string $user_table;
    protected string $meal_table;
    protected string $pricing_table;
    protected string $today;
    public function __construct() {
        date_default_timezone_set("Asia/Dhaka");
        $this -> dbname = Config::$dbname;
        $this -> user_table = Config::$user_table;
        $this -> pdo = new PDO("mysql:host=localhost;dbname=$this->dbname", "root", "root");
        $this->pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this -> meal_table = Config::$meal_table;
        $this -> pricing_table = Config::$pricing_table;

        // insert current date in meal table of db
        $this -> today = date('Y-m-d 0:0:0');
        $date_checker = $this -> pdo -> prepare("SELECT * FROM $this->meal_table WHERE date = :date");
        $date_checker -> bindValue('date', $this -> today);
        $date_checker -> execute();
        if(!count($date_checker -> fetchAll(PDO::FETCH_ASSOC))){
            $insert_meal_date = $this -> pdo -> prepare("INSERT INTO $this->meal_table (date, launch, dinner) VALUES(:date, :launch, :dinner)");
            $insert_meal_date -> bindValue('date', $this -> today);

            //get all User
            $users = $this -> pdo -> prepare("SELECT id FROM $this->user_table ORDER BY id");
            $users -> execute();
            $user_array = $users -> fetchAll(PDO::FETCH_COLUMN);
            $insert_meal_date -> bindValue('launch', json_encode($user_array));
            $insert_meal_date -> bindValue('dinner', json_encode($user_array));
            $insert_meal_date -> execute();
        }
    }
}