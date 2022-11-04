<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<?php

if($_SERVER['SCRIPT_NAME'] === '/cpanel.php' && isset($_GET['edit'] ) && isset($_GET['meal'])) : ?>
    <script>
        document.querySelector('#selectAvailableMeal').addEventListener('change', function (){
            this.closest('form').submit();
        })
    </script>
<?php endif; ?>
</body>
</html>