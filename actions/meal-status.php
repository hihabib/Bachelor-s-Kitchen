<?php
require_once '../vendor/autoload.php';

use kitchen\Meal,
    kitchen\User;
$meal = new Meal();

// update user launch status
if(isset($_POST['launch'])) {
    if(!in_array(User::get_user_id(), $meal -> get_todays_launch())){
        $meal -> add_user_to_launch();
    }
}
else {
    if(in_array(User::get_user_id(), $meal -> get_todays_launch())){
        $meal -> remove_user_from_launch();
    }
}

// update user dinner status
if(isset($_POST['dinner'])){
    if(!in_array(User::get_user_id(), $meal -> get_todays_dinner())){
        $meal -> add_user_to_dinner();
    }
}
else {
    if(in_array(User::get_user_id(), $meal -> get_todays_dinner())){
        $meal -> remove_user_from_dinner();
    }
}
header("Location: /dashboard.php");
