<?php

require_once '../vendor/autoload.php';
use kitchen\Validate,
    kitchen\Meal;
$validate = new Validate();
$meal = new Meal();

if(!$validate->is_admin()) {
    header("Location: /");
}

if(isset($_POST['meal_to_edit'])){
    header("Location: /cpanel.php?meal&edit&action=".$_POST['meal_to_edit']);
}

if(isset($_POST)){
    if(count(explode(" ", $_POST['special_meal_name'])) === 1
        && count(explode(" ", $_POST['special_meal_old_name'])) === 1){
        $meal->edit_meal($_POST);
        header("Location: /cpanel.php?meal&edit&edit=success");
    } else {
        header("Location: /cpanel.php?meal&edit&error=Space%20is%20not%20allowed%20in%20meal%20name");
    }
} else {
    header("Location: /cpanel.php?meal&edit");
}
