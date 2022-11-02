<?php
require_once 'header.php';
?>
<main class="container mt-4">
    <div class="h4">Sign Up</div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>