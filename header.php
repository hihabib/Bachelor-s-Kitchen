<?php
require_once './vendor/autoload.php';
$user_data = new \kitchen\User();
?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
<header class="container mt-3">
    <div class="row">
        <a href="/" class="col-md-6 logo text-4 h3">Bachelor's kitchen</a>
        <div class="offset-md-4 col-md-2">
            <div class="d-flex justify-content-between">
                <?php
                if(!isset($_SESSION['user_id'])) : ?>
                    <div>
                        <a href="login.php" class="btn btn-primary">Login</a>
                        <a href="signup.php" class="btn btn-danger">Sign Up</a>
                    </div>
                <?php else: ?>
                    <div>
                        <span>Hello, <?php echo $user_data->get_username($_SESSION['user_id']); ?></span>
                        <a href="actions/logout.php" class="btn btn-danger">Logout</a>
                    </div>
               <?php endif;  ?>

            </div>
        </div>
    </div>
</header>