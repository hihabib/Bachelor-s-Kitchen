<?php

namespace kitchen;
use PDO;

class Validate extends Connect
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function validate_string($str) : string {
        return trim(stripslashes(htmlspecialchars($str)));
    }

    public function is_email($email) :bool {
        $statement = $this -> pdo -> prepare("SELECT * FROM $this->table_name WHERE email=:email");
        $statement -> bindValue("email", filter_var($email, FILTER_VALIDATE_EMAIL));
        $statement -> execute();
        return (bool) $statement -> fetch(PDO::FETCH_ASSOC);
    }

    public function is_username($username) : bool {
        $statement = $this -> pdo -> prepare("SELECT * FROM $this->table_name WHERE username=:username");
        $statement -> bindValue("username", self::validate_string($username));
        $statement -> execute();
        return (bool) $statement -> fetch(PDO::FETCH_ASSOC);
    }
}