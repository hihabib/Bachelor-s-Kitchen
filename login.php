<?php
require_once 'header.php';
if(\kitchen\Validate::is_user_logged_in()) {
    header("Location: /dashboard.php");
}
?>
<main class="container mt-4">
    <div class="h4">Login</div>
    <form action="actions/authenticate.php" method="post">
        <div class="mb-3">
            <label for="userID" class="form-label">Email address or Username</label>
            <input type="text" name="user" class="form-control" id="userID">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
        <button type="submit" class="btn btn-success">Sign in</button>
    </form>

</main>
<?php require_once 'footer.php'; ?>