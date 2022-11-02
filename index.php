<?php
require_once './vendor/autoload.php';
use kitchen\Connect;


$connect = new Connect();
require_once 'header.php';

?>
<main class="container mt-4">
    <div class="h4">Today's Meal</div>
    <ul class="meal-status">
        <li>
            <form class="d-inline-block" action="meal-status.php">
                <input type="checkbox" id="launch" class="launch" name="update-meal">
                <label class="ms-1" for="launch">Launch</label>
            </form>
        </li>
        <li>
            <form class="d-inline-block" action="meal-status.php">
                <input type="checkbox" id="dinner" name="update-meal">
                <label class="ms-1" for="dinner">Dinner</label>
            </form>
        </li>
    </ul>

</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>