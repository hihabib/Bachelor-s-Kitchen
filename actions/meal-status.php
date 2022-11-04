<?php
require_once '../vendor/autoload.php';

use kitchen\Meal,
    kitchen\User;
$meal = new Meal();

// update user launch status
if(isset($_POST['launch'])) {
    if(!in_array(User::get_user_id(), $meal -> get_todays_meal('launch'))){
        $meal -> add_user_to_meal('launch');
    }
}
else {
    if(in_array(User::get_user_id(), $meal -> get_todays_meal('launch'))){
        $meal -> remove_user_from_meal('launch');
    }
}

// update user dinner status
if(isset($_POST['dinner'])){
    if(!in_array(User::get_user_id(), $meal -> get_todays_meal('dinner'))){
        $meal -> add_user_to_meal('dinner');
    }
}
else {
    if(in_array(User::get_user_id(), $meal -> get_todays_meal('dinner'))){
        $meal -> remove_user_from_meal('dinner');
    }
}
header("Location: /dashboard.php");
