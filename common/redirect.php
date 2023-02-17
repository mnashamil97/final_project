<?php

if (!isset($_SESSION["customer"])) {
?>
    <script>
        window.location = "../view/login.php";
    </script>
<?php
}
