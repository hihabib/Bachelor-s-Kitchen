<?php
if(!isset($_GET['action'])){
    header("Location: ". $_SERVER['REQUEST_URI']. "&action=launch");
}

if(isset($_GET['edit']) && $_GET['edit'] === 'success') : ?>
    <div class="alert alert-success mt-5 alert-dismissible fade show" role="alert">
        <strong>Meal edited successfully</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php if(isset($_GET['error'])) : ?>
    <div class="alert alert-danger mt-5 alert-dismissible fade show" role="alert">
        <strong><?php echo $_GET['error']; ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<form class="mt-5" action="./actions/edit-meal-admin.php" method="post">
    <div class="mb-3">
        <label for="selectAvailableMeal" class="form-label">Select available meal to edit</label>
        <select class="form-select" name="meal_to_edit" id="selectAvailableMeal">
            <?php
            require_once './vendor/autoload.php';
            use kitchen\Meal,
                kitchen\Validate;
            $meal = new Meal();
            $validate = new Validate();
            foreach ($meal -> get_all_meal_arr() as $meal_name) : ?>
                <option <?php echo  $meal_name === $_GET['action'] ? 'selected' : ''; ?> value="<?php echo $meal_name; ?>"><?php echo $meal_name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</form>

<?php
if($validate->is_admin() && isset($_GET['action'])) : ?>

<form action="./actions/edit-meal-admin.php" method="post">
    <?php foreach ( $meal -> get_meal_schema($_GET['action']) as $data) : ?>
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
    <div class="mb-3">
        <label for="special_meal_name">Special Meal Name <strong>(Without space)</strong></label>
        <input type="text" value="<?php echo $data['name'] ?>" class="form-control" name="special_meal_name" id="special_meal_name">
        <input type="hidden" value="<?php echo $data['name'] ?>"  name="special_meal_old_name">
    </div>
    <div class="mb-3">
        <label for="special_meal_price">Special Meal Price</label>
        <input type="number" value="<?php echo $data['price'] ?>" class="form-control" name="special_meal_price" id="special_meal_price">
    </div>
    <div class="mb-3">
        <label for="special_day">Select Meal day</label>
        <select name="day" id="special_day" class="form-select">
            <option <?php echo $data['day'] === 'All' ? 'selected' : ''; ?> value="All">All</option>
            <option <?php echo $data['day'] === 'Sat' ? 'selected' : ''; ?> value="Sat">Saturday</option>
            <option <?php echo $data['day'] === 'Sun' ? 'selected' : ''; ?> value="Sun">Sunday</option>
            <option <?php echo $data['day'] === 'Mon' ? 'selected' : ''; ?> value="Mon">Monday</option>
            <option <?php echo $data['day'] === 'Tue' ? 'selected' : ''; ?> value="Tue">Tuesday</option>
            <option <?php echo $data['day'] === 'Wed' ? 'selected' : ''; ?> value="Wed">Wednesday</option>
            <option <?php echo $data['day'] === 'Thu' ? 'selected' : ''; ?> value="Thu">Thursday</option>
            <option <?php echo $data['day'] === 'Fri' ? 'selected' : ''; ?> value="Fri">Friday</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="special_day_instead_of">Instead Of</label>
        <select name="instead_of" id="special_day_instead_of" class="form-select">
            <option <?php echo $data['instead_of'] === 'none' ? 'selected' : ''; ?> value="none">None</option>
            <option <?php echo $data['instead_of'] === 'launch' ? 'selected' : ''; ?> value="launch">Launch</option>
            <option <?php echo $data['instead_of'] === 'dinner' ? 'selected' : ''; ?> value="dinner">Dinner</option>
        </select>
    </div>
    <button type="submit" class="btn btn-danger">Update</button>
    <?php endforeach; ?>
</form>
<?php endif; ?>

