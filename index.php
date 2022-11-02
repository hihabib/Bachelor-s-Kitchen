<?php
require_once './vendor/autoload.php';
require_once 'header.php';

if(\kitchen\Validate::is_user_logged_in()){
   header("Location: /dashboard.php");
} else {
    header("Location: /login.php");
}
