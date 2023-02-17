<?php
include_once("../common/cart_session.php");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/icon" href="../image/logo/logo1.png">

    <title>BOSARA TEXTILE</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="../resources/datatablesAlt/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">

    <link rel="stylesheet" href="../css/custom.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="../resources/datatablesAlt/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../resources/datatablesAlt/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.0/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

</head>

<body>
    <div style="background-color: #db9200; height:8px;"></div>

    <nav class="navbar navbar-expand-md navbar-light bg-light p-2">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-1 order-md-0" id="navbarNav">
            <ul class="navbar-nav fw-bold">
                <li class="nav-item me-2">
                    <a href="home.php" class="text-decoration-underline" style="color:#808080">Home</a>
                </li>
                <li class="nav-item me-2">
                    <a href="dashboard.php" class="text-decoration-underline" style="color:#808080">My Profile</a>
                </li>
                <li class="nav-item me-2">
                    <a href="contactus.php" class="text-decoration-underline" style="color:#808080">Contact Us</a>
                </li>
                <li class="nav-item font-weight-lighter">
                    <div>
                        <a href="tel:+94763669100" class="me-2" style="color:#808080"><i class="fas fa-phone-rotary"></i> +94 763669100</a>
                        <a href="https://www.facebook.com" class="me-2" target="_blank" style="color:#808080"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.twitter.com" class="me-2" target="_blank" style="color:#808080"><i class="fab fa-twitter"></i></i></a>
                        <a href="https://www.youtube.com" class="me-2" target="_blank" style="color:#808080"><i class="fab fa-youtube"></i></a>
                    </div>
                </li>
            </ul>
        </div>

        <div>
            <span class="ps-2 me-2" style="color:#808080;">
                <span style="font-size: larger"><i class="fas fa-user-circle"></i></span>

                <?php if (isset($_SESSION["customer"])) { ?>
                    <span>Hi...! <?php echo $_SESSION["customer"]["cusFname"]; ?></span> &nbsp;
                    <a id="logoutBtn" href="../controller/login_controller.php?type=logout" class="button btn border-0 text-white text-uppercase text-decoration-none" style="color:#808080;">
                        <i class="fas fa-sign-in-alt"></i> Logout
                    </a>
                <?php } else { ?>

                    <span>Hi...! User</span> &nbsp;
                    <a id="loginBtn" href="login.php" class="button btn border-0 text-white text-uppercase text-decoration-none" style="color:#808080;">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                <?php } ?>
            </span>
        </div>

    </nav>

    <!-- /////////////////////////////////// 2nd Navbar ///////////////////////////////////// -->
    <nav class="navbar sec-nav sticky-top navbar-expand-sm justify-content-center">

        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button> -->

        <div class="d-none d-sm-block me-auto">
            <div class="navbar-brand">
                <img src="../image/logo/logo1.png" width="200px" height="100px" class="align-top" alt="logo">
            </div>
        </div>

        <ul class="navbar-nav text-uppercase fw-bolder">
            <li class="nav-item">
                <a class="nav-link navmenu" href="home.php#newIn">new in</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navmenu" href="home.php#collection">collections</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navmenu" href="aboutUs.php">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navmenu" href="cart.php" style="font-size: large">
                    <i class="fas fa-shopping-cart"></i>

                    <?php $count = isset($_SESSION["cart"]) ? count($_SESSION["cart"]) : "0"; ?>

                    <span class="badge badge-notify text-white">
                        <?php echo $count; ?>
                    </span>
                </a>
            </li>
        </ul>
    </nav>