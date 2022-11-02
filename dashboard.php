<?php
require_once './vendor/autoload.php';
require_once 'header.php';
if(!\kitchen\Validate::is_user_logged_in()){
    header("Location: /login.php");
}

?>
    <main class="container mt-4">
        <div class="h4">Today's Meal</div>
        <form class="d-inline-block" action="actions/meal-status.php">
            <ul class="meal-status">
                <li>
                    <input type="checkbox" id="launch" class="launch" name="launch">
                    <label class="ms-1" for="launch">Launch</label>
                </li>
                <li>
                    <input type="checkbox" id="dinner" name="dinner">
                    <label class="ms-1" for="dinner">Dinner</label>
                </li>
            </ul>
            <input type="submit" value="Update" class="btn btn-primary">
        </form>
    </main>
<?php require_once 'footer.php'; ?>