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
        $statement = $this -> pdo -> prepare("SELECT * FROM $this->user_table WHERE email=:email");
        $statement -> bindValue("email", filter_var($email, FILTER_VALIDATE_EMAIL));
        $statement -> execute();
        return (bool) $statement -> fetch(PDO::FETCH_ASSOC);
    }

    public function is_username($username) : bool {
        $statement = $this -> pdo -> prepare("SELECT * FROM $this->user_table WHERE username=:username");
        $statement -> bindValue("username", self::validate_string($username));
        $statement -> execute();
        return (bool) $statement -> fetch(PDO::FETCH_ASSOC);
    }

    public static function is_user_logged_in() : bool
    {
        if(isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }
    public function is_admin() : bool
    {
        if(self::is_user_logged_in()){
            $role = $this -> pdo -> prepare("SELECT role FROM $this->user_table WHERE id = :id");
            $role -> bindValue('id', User::get_user_id());
            $role -> execute();
            return $role -> fetch(PDO::FETCH_COLUMN) === 'admin';
        } else {
            return false;
        }
    }
}