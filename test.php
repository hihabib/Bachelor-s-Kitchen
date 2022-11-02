<?php
require_once './vendor/autoload.php';
$user = new \kitchen\User();
foreach ($user -> get_all_user_id() as $id) {
    echo '<br>';
    echo $id;
}