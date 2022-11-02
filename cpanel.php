<?php
require_once './header.php';

$validate = new \kitchen\Validate();

if(!$validate->is_admin()){
    header("Location: /");
}
if(!count($_GET)){
    header("Location: /cpanel.php?overview");
}
?>

<div class="container mt-5">
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link active" href="?overview">Overview</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?members">Members</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?meal_rates">Meal rates</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?accounts">Accounts</a>
        </li>
    </ul>
    <?php
    if(isset($_GET['overview'])) {
        require_once 'cpanel/overview.php';
    } elseif(isset($_GET['members'])) {
        require_once 'cpanel/members.php';
    } elseif(isset($_GET['meal_rates'])){
        require_once 'cpanel/meal_rates.php';
    } elseif(isset($_GET['accounts'])){
        require_once 'cpanel/accounts.php';
    }
    ?>
</div>

<?php

require_once './footer.php';