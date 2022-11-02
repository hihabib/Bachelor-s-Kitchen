<?php
require_once '../vendor/autoload.php';
use kitchen\Validate,
    kitchen\User;

$validate = new Validate();
$user = new User();

if($validate -> is_email($_POST['user'])){
    $user_id = $user -> auth_with_email($_POST);
    if($user_id){
        $user ->user_session($user_id);
        header("Location: /");
    } else {
        header("Location: /login.php?error=pass");
    }
} elseif ($validate -> is_username($_POST['user'])) {
    $user_id = $user -> auth_with_username($_POST);
    if($user_id){
        $user ->user_session($user_id);
        header("Location: /");
    } else {
        header("Location: /login.php?error=pass");
    }
} else {
    header("Location: /login.php?error=user");
}