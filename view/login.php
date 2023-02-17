<?php
include_once("navbar.php");

$response = isset($_GET["response"]) ? $_GET["response"] : "";
$status = isset($_GET["status"]) ? $_GET["status"] : "";
$email = $_SESSION["otp"]["email"] ?? "";
?>

<!-- content -->
<div class="container-fluid">

    <!-- /////////////////// Top Banner ///////////////////// -->
    <div class="row">
        <div class="col-md-12 text-center p-5" style="background-image:url('../image/background/1-12.webp');">
            <p class="text-uppercase p-2 m-auto text-white font-weight-lighter" style=" font-family: montserrat,serif; font-size: 40px;">My Profile</p>
            <p class="text-uppercase pt-3 pb-0 m-auto text-white font-weight-lighter ">
                <a class="text-decoration-none" style=" font-family: montserrat,serif; color:#db9200" href="home.php">Home</a> &rarr; My Profile
            </p>
        </div>
    </div>
    <!-- ///////////////////// Banner End /////////////////////// -->

    <?php if ($status != "") { ?>
        <!-- //////////////////// Response Alert /////////////////////// -->
        <div class="row mt-3 mb-3">
            <div class="col-10  mx-auto text-center">
                <div class="alert alert-<?php echo $status; ?> alert-dismissible fade show" role="alert">
                    <h3 class="text-center text-<?php echo $status; ?>"><?php echo $response; ?></h3>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        <!-- //////////////////// Response Alert /////////////////////// -->
    <?php } ?>

    <div class="row mt-3">
        <!-- login -->
        <div class="col-sm-6 text-muted p-4 p-sm-5">

            <p class="font-weight-lighter text-uppercase" style="font-family: montserrat,serif; font-size: xx-large"><i class="fas fa-key"></i> LOGIN</p>

            <form id="newCustomer" action="../controller/login_controller.php?type=login" method="POST">
                <label class="control-label">Username <span class="text-danger"> *</span></label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off" value="<?php echo $email; ?>" required>
                <br>
                <label class="control-label">Password <span class="text-danger"> *</span></label>
                <div class="input-group">
                    <input type="password" id="pw" class="form-control" name="pw" placeholder="Password" required>

                    <span class="input-group-text" id="pw_append" style="cursor: pointer;">
                        <i id="pw_icon" class="fas fa-eye"></i>
                    </span>
                </div>
                <div class="mt-2">
                    <input name="keepLogin" type="checkbox" class="form-control-checkbox"> Keep Me Logged in
                </div>
                <button class="btn button text-white text-uppercase mt-2">Login</button>
                <a href="passwordReset.php" class="btn btn-link text-uppercase mt-3 float-right">Forgot Your Password ?</a>
            </form>

        </div>
        <!-- login end -->

        <!-- register -->
        <div class="col-sm-6 text-muted p-4 p-sm-5" style="border-left: outset;">
            <p class="font-weight-lighter text-uppercase" style=" font-family: montserrat,serif; font-size: xx-large"><i class="fas fa-clipboard-user"></i> REGISTER</p>

            <form action="../controller/login_controller.php?type=sendOTP" method="POST">
                <label class="control-label">Username <span class="text-danger"> *</span></label>
                <input type="email" class="form-control" name="email" id="reg_email" placeholder="Email" required autocomplete="off">
                <h5 class="text-danger" id="email_response"></h5>
                <br>
                <p>A Temporary password will be sent to your email address.</p>
                <p class="text-justify">Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy.</p>
                <button type="submit" class="btn button text-white text-uppercase" id="registerBtn">REGISTER</button>
            </form>

        </div>
        <!-- register end -->
    </div>
</div>
<!-- content end -->

<script>
    document.title = "BOSARA TEXTILE | Login";
</script>
<script src="../js/login.js"></script>

<?php
include_once("footer.php")
?>