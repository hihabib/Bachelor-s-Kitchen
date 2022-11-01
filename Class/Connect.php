<?php

namespace kitchen;
use PDO;

class Connect {
    public PDO $pdo;
    private string $dbname;
    private string $table_name;

    public function __construct() {
        $this -> dbname = Config::$dbname;
        $this -> table_name = Config::$table_name;
        $this -> pdo = new PDO("mysql:host=localhost;dbname=$this->dbname", "root", "root");
        $this->pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function user_signup($data) : array
    {
        // user information
        $username = Validate::validate_string($data['username']);
        $password = md5($data['password']);
        $email = filter_var($data['email'], FILTER_VALIDATE_EMAIL) ? $data['email'] : '';

        // check if the username is unique or not
        $username_check = $this -> pdo -> prepare("SELECT * FROM $this->table_name WHERE username = :username");
        $username_check -> bindValue('username', $username);
        $username_check -> execute();

        if($username_check -> fetchColumn()){
            return ['error' => 'username already exists'];
        }

        // check if the email is unique or not
        $email_check = $this -> pdo -> prepare("SELECT * FROM $this->table_name WHERE email = :email");
        $email_check -> bindValue("email", $email);
        $email_check -> execute();

        if($email_check -> fetchColumn()){
            return ['error' => 'Email already exists'];
        }

        if($email){
            // register user
            $register = $this -> pdo -> prepare("INSERT INTO users (username, password, email, registered_at) VALUES (:username, :password, :email, :registered_at)");

            $register -> bindValue('username', $username);
            $register -> bindValue('password', $password);
            $register -> bindValue('email', $email);
            $register -> bindValue('registered_at', date('Y-m-d H:i:s'));
            $register -> execute();

            // get registered user id
            $statement = $this -> pdo -> prepare("SELECT * FROM $this->table_name WHERE email = :email");
            $statement -> bindValue("email", $email);
            $statement -> execute();
            $userData = $statement -> fetch(PDO::FETCH_ASSOC);


            return ['error' => 'none','id'=> $userData['id']];
        } else {
            return ['error' => 'Invalid email'];
        }

    }
}