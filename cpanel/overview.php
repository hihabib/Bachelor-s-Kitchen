<table class="table table-striped mt-5">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Launch</th>
            <th scope="col">Dinner</th>
            <th scope="col">Total</th>
        </tr>
    </thead>
    <tbody>
    <?php
    require_once './vendor/autoload.php';

    use kitchen\Meal;

    $meal = new Meal();
    foreach ($meal -> meal_overview() as $user_data) :
    ?>
        <tr>
            <th scope="row"><?php echo$user_data['id'] ?></th>
            <td><?php echo $user_data['username'] ?></td>
            <td><?php echo $user_data['launch'] ?></td>
            <td><?php echo $user_data['dinner'] ?></td>
            <td><?php echo $user_data['total'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>