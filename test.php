<?php
require_once './vendor/autoload.php';
$meal = new \kitchen\Meal();

var_dump($meal -> get_meal_schema('launch'));