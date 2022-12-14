<?php

namespace kitchen;
use PDO;

class User extends Connect
{
    public function __construct()
    {
        parent::__construct();
    }
    // set user session data (usually after login)
    public function user_session($id) :void
    {
        $_SESSION['user_id'] = $id;
    }

    public static function get_user_id() : int
    {
        return (int)$_SESSION['user_id'];
    }

    public function get_all_user_id() : array
    {
        $users = $this -> pdo -> prepare("SELECT id FROM $this->user_table ORDER BY id");
        $users -> execute();
        return $users -> fetchAll(PDO::FETCH_COLUMN);
    }
    public function user_data($id) : array
    {
        $user = $this -> pdo -> prepare("SELECT * FROM $this->user_table WHERE id = :id");
        $user -> bindValue('id', $id);
        $user -> execute();
        return $user -> fetch(PDO::FETCH_ASSOC);
    }
    // get registered user id
    public function get_user_id_by_email($email) : string
    {
        $statement = $this -> pdo -> prepare("SELECT * FROM $this->user_table WHERE email = :email");
        $statement -> bindValue("email", filter_var($email, FILTER_VALIDATE_EMAIL));
        $statement -> execute();
        return $statement -> fetch(PDO::FETCH_ASSOC)['id'];
    }

    // get registered user id
    public function get_user_id_by_username($username) : string
    {
        $statement = $this -> pdo -> prepare("SELECT * FROM $this->user_table WHERE username = :username");
        $statement -> bindValue("username", Validate::validate_string($username));
        $statement -> execute();
        return $statement -> fetch(PDO::FETCH_ASSOC)['id'];
    }
    // get username by ID
    public function get_username($id) : string
    {
        return $this -> user_data($id)['username'];
    }

    // user signup
    public function user_signup($data) : array
    {
        // user information
        $username = Validate::validate_string($data['username']);
        $password = md5($data['password']);
        $email = filter_var($data['email'], FILTER_VALIDATE_EMAIL) ? $data['email'] : '';

        // check if the username is unique or not
        $username_check = $this -> pdo -> prepare("SELECT * FROM $this->user_table WHERE username = :username");
        $username_check -> bindValue('username', $username);
        $username_check -> execute();

        if($username_check -> fetchColumn()){
            return ['error' => 'username already exists'];
        }

        // check if the email is unique or not
        $email_check = $this -> pdo -> prepare("SELECT * FROM $this->user_table WHERE email = :email");
        $email_check -> bindValue("email", $email);
        $email_check -> execute();

        if($email_check -> fetchColumn()){
            return ['error' => 'Email already exists'];
        }

        if($email){
            // register user
            $register = $this -> pdo -> prepare("INSERT INTO $this->user_table (username, password, email, registered_at, role) VALUES (:username, :password, :email, :registered_at, :role)");

            $register -> bindValue('username', $username);
            $register -> bindValue('password', $password);
            $register -> bindValue('email', $email);
            $register -> bindValue('role', 'member');
            $register -> bindValue('registered_at', date('Y-m-d H:i:s'));
            $register -> execute();

            return ['error' => 'none','id'=> $this->get_user_id_by_email($email)];
        } else {
            return ['error' => 'Invalid email'];
        }
    }

    public function auth_with_email($user_data) : string
    {
        $statement = $this -> pdo -> prepare("SELECT * FROM $this->user_table WHERE email = :email AND password = :password");
        $statement -> bindValue('email', filter_var($user_data['user'], FILTER_VALIDATE_EMAIL));
        $statement -> bindValue('password', md5($user_data['password']));
        $statement -> execute();
        if(count($statement -> fetchAll(PDO::FETCH_ASSOC))) {
            return $this->get_user_id_by_email($user_data['user']);
        } else {
            return '';
        }

    }

    public function auth_with_username($user_data) : string
    {
        $statement = $this -> pdo -> prepare("SELECT * FROM $this->user_table WHERE username = :username AND password = :password");
        $statement -> bindValue('username', Validate::validate_string($user_data['user']));
        $statement -> bindValue('password', md5($user_data['password']));
        $statement -> execute();
        if(count($statement ->fetchAll(PDO::FETCH_ASSOC))) {
            return $this->get_user_id_by_username($user_data['user']);
        } else {
            return '';
        }
    }


}