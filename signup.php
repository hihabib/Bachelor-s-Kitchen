<?php
session_start();

require_once 'header.php';

if(isset($_SESSION['user_id'])){
    echo $_SESSION['user_id'];
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
            <div id="emailHelp" class="form-text">You will need this at the time of sign in and recover your password</div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>