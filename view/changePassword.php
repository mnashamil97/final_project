<?php
include_once("navbar.php");

if (isset($_SESSION["customer"])) {
    $customerId = $_SESSION["customer"]["cusId"];
} else if (isset($_GET["resetKey"])) {

    if ($_GET["resetKey"] !==  $_SESSION["resetKey"]) {
        $response = "Session Has Been Expired";
        $status = "danger";
?>
        <script>
            window.location = "login.php?response=<?php echo $response; ?>&status=<?php echo $status; ?>";
        </script>
<?php
    }

    $customerId = base64_decode($_GET["customerId"]);
}


$response = isset($_GET["response"]) ? $_GET["response"] : "";
$status = isset($_GET["status"]) ? $_GET["status"] : "";
?>

<!-- content -->
<div class="container-fluid">
    <!--    banner-->
    <div class="row">
        <div class="col-md-12 text-center p-5" style="background-image:url('../image/background/1-12.webp');">
            <p class="text-uppercase p-2 m-auto text-white font-weight-lighter" style=" font-family: montserrat,serif; font-size: 40px;">My Profile</p>
            <p class="text-uppercase pt-3 pb-0 m-auto text-white font-weight-lighter ">
                <a class="text-decoration-none" style=" font-family: montserrat,serif; color:#db9200" href="home.php">Home</a> &rarr;
                <a class="text-decoration-none" style=" font-family: montserrat,serif; color:#db9200" href="dashboard.php">My Profile</a> &rarr; Change Password
            </p>
        </div>
    </div>
    <!--    banner end -->

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
</div>

<div class="container">

    <div class="card mt-3 mb-3">
        <div class="card-body">

            <!-- reset password -->
            <form class="pb-5 mt-3" id="changePw" action="../controller/customer_controller.php?type=changePW" method="POST">

                <input type="hidden" name="customerId" id="customerId" value="<?php echo $customerId; ?>">

                <?php if (!isset($_GET["resetKey"])) { ?>
                    <div class="row mt-2">
                        <div class="col-sm-6 text-muted text-end">
                            <label for="" class="control-label">Current Password <i class="text-danger">*</i></label>
                        </div>
                        <div class="col-sm-6 text-muted">
                            <input type="password" name="pw" id="pw" class="form-control" required>
                        </div>
                    </div>
                <?php } ?>

                <div class="row mt-2">
                    <div class="col-sm-6 text-muted text-end">
                        <label for="" class="control-label">New Password <i class="text-danger">*</i></label>
                    </div>
                    <div class="col-sm-6 text-muted">
                        <div class="input-group">
                            <input type="password" name="npw" id="npw" class="form-control" required minlength="6">

                            <span class="input-group-text" id="pw_append" style="cursor: pointer;">
                                <i id="pw_icon" class="fas fa-eye"></i>
                            </span>
                        </div>
                        <div class="progress" style="width: 90%;">
                            <div id="progressBar" class="progress-bar" role="progressbar"></div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-sm-6 text-muted text-end"><label for="" class="control-label">Retype New Password <i class="text-danger">*</i></label></div>
                    <div class="col-sm-6 text-muted">
                        <div class="input-group">
                            <input type="password" name="cpw" id="cpw" class="form-control" value="" required minlength="6">

                            <span style="cursor: pointer;" class="input-group-text" id="cpw_append">
                                <i id="cpw_icon" class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-sm-6 ms-auto text-muted">
                        <button type="submit" class="btn btn-block button text-white text-uppercase float-right">Reset password</button>
                    </div>
                </div>

            </form>
            <!-- reset password end -->
        </div>
    </div>

</div>
<!-- content end -->

<script src="../js/changePw.js"></script>

<?php
include_once("footer.php");
?>