<?php
require_once './vendor/autoload.php';
require_once 'header.php';

use kitchen\Validate,
    kitchen\User,
    kitchen\Meal;
$meal = new Meal();
if(!Validate::is_user_logged_in()){
    header("Location: /login.php");
}

?>
    <main class="container mt-4">
        <div class="h4">Today's Meal</div>
        <form class="d-inline-block" action="actions/meal-status.php" method="post">
            <ul class="meal-status">
                <li>
                    <input value="launch" <?php echo in_array(User::get_user_id(), $meal -> get_todays_launch()) ? 'checked' : ''?> type="checkbox" id="launch" class="launch" name="launch">
                    <label class="ms-1" for="launch">Launch</label>
                </li>
                <li>
                    <input value="dinner" <?php echo in_array(User::get_user_id(), $meal -> get_todays_dinner()) ? 'checked' : ''?> type="checkbox" id="dinner" name="dinner">
                    <label class="ms-1" for="dinner">Dinner</label>
                </li>
            </ul>
            <input type="submit" value="Update" class="btn btn-primary">
        </form>
    </main>
<?php require_once 'footer.php'; ?>