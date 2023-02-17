<?php

session_start();

if (isset($_SESSION["customer"])) {
    header("Location: view/dashboard.php");
} else if (isset($_COOKIE["cusEmail"])) {
    $email = $_COOKIE["cusEmail"];
    header("Location: controller/login_controller.php?type=keepLogin&email=$email");
} else {
    header("Location: view/home.php");
}
