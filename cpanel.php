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
            <a class="nav-link <?php echo isset($_GET['overview']) ? 'active' : ''; ?>" href="?overview">Overview</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo isset($_GET['meal']) ? 'active' : ''; ?>" href="?meal">Meal</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo isset($_GET['members']) ? 'active' : ''; ?>" href="?members">Members</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo isset($_GET['accounts']) ? 'active' : ''; ?>" href="?accounts">Accounts</a>
        </li>
    </ul>
    <?php
    if(isset($_GET['overview'])) {
        require_once 'cpanel/overview.php';
    } elseif(isset($_GET['members'])) {
        require_once 'cpanel/members.php';
    } elseif(isset($_GET['meal'])){
        require_once 'cpanel/meal.php';
    } elseif(isset($_GET['accounts'])){
        require_once 'cpanel/accounts.php';
    }
    ?>
</div>

<?php

require_once './footer.php';