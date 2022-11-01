<?php
session_start();

require_once '../vendor/autoload.php';
$connect = new \kitchen\Connect();

if($_POST['password'] !== $_POST['repeat_password']){
    header("Location: /signup.php?failed=Password%20is%20not%20matched");
} else {
    $response = $connect -> user_signup($_POST);
    switch ($response['error']) {
        case 'none':
            $_SESSION['user_id'] = $response['id'];
            header("Location: /?reg=success");
            break;
        case 'username already exists':
            header('Location: /signup.php?failed=Username%20already%20exists');
            break;
        case 'Email already exists':
            header('Location: /signup.php?failed=Email%20already%20exists');
            break;
        case 'Invalid email' :
            header("Location: /signup.php?failed=Invalid%20Email");
            break;
        default :
            header("Location: /signup.php?failed=". $response['error']);
    }
}


