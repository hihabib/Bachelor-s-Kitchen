<?php
if(count($_GET) === 1) {
    header("Location: ?meal&add_new");
}
?>

<div class="d-flex mt-4">
    <div class="me-4">
        <a href="?meal&add_new">Add Special Meal</a>
    </div>
    <div class="me-4">
        <a href="?meal&edit">Edit Meal setting</a>
    </div>
</div>
<?php

isset($_GET['add_new']) && require_once './cpanel/meal-options/add-special-meal.php';
isset($_GET['edit']) && require_once './cpanel/meal-options/edit-meal.php';



?>