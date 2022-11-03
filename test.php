<?php
require_once './vendor/autoload.php';
$meal = new \kitchen\Meal();

print_r($meal -> meal_overview());