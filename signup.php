<?php


require_once 'header.php';
if(\kitchen\Validate::is_user_logged_in()) {
    header("Location: /dashboard.php");
}
?>
<main class="container mt-4">
    <div class="h4">Sign Up</div>
    <form action="actions/register.php" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input name="email" type="email" class="form-control" id="email">
            <div class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input name="username" type="text" class="form-control" id="username">
            <div class="form-text">You will need this at the time of sign in and recover your password</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="password">
        </div>
        <div class="mb-3">
            <label for="repeat-password" class="form-label">Retype Password</label>
            <input name="repeat_password" type="password" class="form-control" id="repeat-password">
        </div>
        <button type="submit" class="btn btn-success">Sign up</button>
    </form>

</main>
<?php require_once 'footer.php'; ?>