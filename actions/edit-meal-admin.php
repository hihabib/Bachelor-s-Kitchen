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
    if(!isset($_POST['delete_meal'])){
        if(count(explode(" ", $_POST['special_meal_name'] ?? $_POST['meal_old_name'])) === 1
            && count(explode(" ", $_POST['special_meal_old_name'] ?? $_POST['meal_old_name'])) === 1){
            $meal->edit_meal($_POST);
            header("Location: /cpanel.php?meal&edit=success");
        } else {
            header("Location: /cpanel.php?meal&edit&error=Space%20is%20not%20allowed%20in%20meal%20name");
        }
    } else {
        // delete meal
        $meal -> delete_meal($_POST['meal_old_name']);
        header("Location: /cpanel.php?meal&edit=deleted");
    }
} else {
    header("Location: /cpanel.php?meal&edit");
}
