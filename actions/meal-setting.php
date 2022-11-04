<?php
require_once '../vendor/autoload.php';
$meal = new \kitchen\Meal();

if(isset($_POST)){
    if(count(explode(" ", $_POST['special_meal_name'])) === 1){
        $meal->add_special_meal($_POST);
        header("Location: /cpanel.php?meal&add_new&added=true");
    } else {
        header("Location: /cpanel.php?meal&add_new&error=Space%20is%20not%20allowed%20in%20meal%20name");
    }
} else {
    header("Location: /cpanel.php?meal&add_new");
}
