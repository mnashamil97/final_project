<?php
include_once("navbar.php");

$email = $_GET["email"] ?? "";

$response = isset($_GET["response"]) ? $_GET["response"] : "";
$status = isset($_GET["status"]) ? $_GET["status"] : "";
?>

<!-- content -->
<div class="container-fluid">
    <!--    banner-->
    <div class="row">
        <div class="col-md-12 text-center p-5" style="background-image:url('../image/background/1-12.webp');">
            <p class="text-uppercase p-2 m-auto text-white font-weight-lighter" style=" font-family: montserrat,serif; font-size: 40px;">Register Form</p>
            <p class="text-uppercase pt-3 pb-0 m-auto text-white font-weight-lighter "><a class="text-decoration-none" style=" font-family: montserrat,serif; color:#db9200" href="index.php">Home</a> &rarr; <a class="text-decoration-none" style=" font-family: montserrat,serif; color:#db9200" href="login.php">My Profile</a> &rarr; Register Form</p>
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

    <div class="row mt-3 mb-3">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12">
                    <div id="alert"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div>
                        <p class="text-danger">* required fields </p>
                    </div>
                    <form id="addCustomer" action="../controller/customer_controller.php?type=addNewCustomer" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-2 text-muted">
                                <label class="control-label">Email</label>
                            </div>
                            <div class="col-sm-6 col-md-4 text-muted">
                                <input type="email" value="<?php echo $email; ?>" name="email" id="email" class="form-control bg-secondary text-light" required readonly style="background-color: white;">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label class="control-label">First Name <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="text" name="fname" id="fname" class="form-control" required>
                            </div>
                            <div class="col-sm-2 text-muted">
                                <label class="control-label">Last Name <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="text" name="lname" id="lname" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label class="control-label">Contact Number <i class="text-danger">*</i>
                                </label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <div class="input-group">
                                    <span class="input-group-text">0</span>
                                    <input type="number" name="contact" id="contact" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-2 text-muted">
                                <label class="control-label">NIC <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted ">
                                <input type="text" name="nic" id="nic" class="form-control" required autocomplete="off">
                                <h5 id="nic_response" class="text-danger"></h5>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label class="control-label">Gender <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadio1" name="gender" class="custom-control-input" value="M">
                                    <label class="custom-control-label" for="customRadio1">Male</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadio2" name="gender" class="custom-control-input" value="F">
                                    <label class="custom-control-label" for="customRadio2">Female</label>
                                </div>
                            </div>
                            <div class="col-sm-2 text-muted">
                                <label class="control-label">Postal Code <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="number" name="postalcode" id="postalcode" class="form-control" minlength="5" maxlength="5" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label class="control-label">New password <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <div class="input-group">
                                    <input type="password" name="pw" id="pw" class="form-control" required minlength="6">

                                    <span class="input-group-text" id="pw_append" style="cursor: pointer;">
                                        <i id="pw_icon" class="fas fa-eye"></i>
                                    </span>
                                </div>
                                <div class="progress" style="width: 90%;">
                                    <div id="progressBar" class="progress-bar" role="progressbar"></div>
                                </div>
                            </div>
                            <div class="col-sm-2 text-muted">
                                <label class="control-label">Confirm Password <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <div class="input-group">
                                    <input type="password" name="cpw" id="cpw" class="form-control" required minlength="6">

                                    <span class="input-group-text" id="cpw_append" style="cursor: pointer;">
                                        <i id="cpw_icon" class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label class="control-label">Address <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-3 text-muted pe-0 mt-1 mt-sm-0">
                                <input type="text" name="addr1" id="addr1" class="form-control " placeholder="Street Address 01" required>
                            </div>
                            <div class="col-sm-3 text-muted pe-0 mt-1 mt-sm-0">
                                <input type="text" name="addr2" id="addr2" class="form-control " placeholder="Street Address 02" required>
                            </div>
                            <div class="col-sm-3 text-muted pe-0 mt-1 mt-sm-0">
                                <input type="text" name="addr3" id="addr3" class="form-control" placeholder="City" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label class="control-label">User Image</label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="file" name="uimg" id="uimg" class="form-control-file">
                                <!-- Image Preview -->
                                <div>
                                    <img src="" id="prev_img" alt="" class="mt-1">
                                </div>
                                <!-- Preview End -->
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-sm-4 text-muted">
                                <button id="submit" type="submit" class="btn btn-block button text-white text-uppercase"><i class="fas fa-save"></i>&nbsp; &nbsp; Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="../js/register.js"></script>

<?php
include_once("footer.php");
?>