<?php if(isset($_GET['added']) && $_GET['added'] === 'true') : ?>
    <div class="alert alert-success mt-5 alert-dismissible fade show" role="alert">
        <strong>New Meal Added</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php if(isset($_GET['error'])) : ?>
    <div class="alert alert-danger mt-5 alert-dismissible fade show" role="alert">
        <strong><?php echo $_GET['error']; ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<form class="mt-5" action="actions/meal-setting.php" method="post">
    <div class="mb-3">
        <label for="special_meal_name">Special Meal Name <strong>(Without space)</strong></label>
        <input type="text" class="form-control" name="special_meal_name" id="special_meal_name">
    </div>
    <div class="mb-3">
        <label for="special_meal_price">Special Meal Price</label>
        <input type="number" class="form-control" name="special_meal_price" id="special_meal_price">
    </div>
    <div class="mb-3">
        <label for="special_day">Select Special Meal day</label>
        <select name="day" id="special_day" class="form-select">
            <option value="Sat">Saturday</option>
            <option value="Sun">Sunday</option>
            <option value="Mon">Monday</option>
            <option value="Tue">Tuesday</option>
            <option value="Wed">Wednesday</option>
            <option value="Thu">Thursday</option>
            <option selected value="Fri">Friday</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="special_day_instead_of">Instead Of</label>
        <select name="instead_of" id="special_day_instead_of" class="form-select">
            <option value="launch">Launch</option>
            <option selected value="dinner">Dinner</option>
        </select>
    </div>
    <button type="submit" class="btn btn-danger">Add</button>
</form>