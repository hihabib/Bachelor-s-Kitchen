<?php
session_start();

require_once '../vendor/autoload.php';
$user = new \kitchen\User();

if($_POST['password'] !== $_POST['repeat_password']){
    header("Location: /signup.php?failed=Password%20is%20not%20matched");
} else {
    $response = $user -> user_signup($_POST);
    switch ($response['error']) {
        case 'none':
            $user->user_session($response['id']);
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


