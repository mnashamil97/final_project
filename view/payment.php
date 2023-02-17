<?php
include_once("navbar.php");

include_once("../common/redirect.php");

$customerId = $_SESSION["customer"]["cusId"];

include_once("../model/customer_model.php");
$customer_obj = new Customer($conn);

$cusInfo = $customer_obj->giveCustomer_infoById($customerId);
$cusArray = $cusInfo->fetch_assoc();

$response = isset($_GET["response"]) ? $_GET["response"] : "";
$status = isset($_GET["status"]) ? $_GET["status"] : "";
?>

<!-- content -->
<div class="container-fluid">
    <!--    banner-->
    <div class="row">
        <div class="col-md-12 text-center p-5" style="background-image:url('../image/background/1-12.webp');">
            <p class="text-uppercase p-2 m-auto text-white font-weight-lighter" style=" font-family: montserrat,serif; font-size: 40px;">Shipping Details</p>
            <p class="text-uppercase pt-2 pb-0 m-auto text-white font-weight-lighter "><a class="text-decoration-none" style=" font-family: montserrat,serif; color:#db9200" href="home.php">Home</a> &rarr; <a class="text-decoration-none" style=" font-family: montserrat,serif; color:#db9200" href="cart.php">cart</a> &rarr; Shipping details</p>
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
    <div class="row justify-content-center p-3">
        <div class="col-sm-12 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3 scard">

                <form id="paymentForm" action="../controller/order_controller.php?type=addNewOrder" method="POST">

                    <!-- // progressbar -->
                    <ul id="progressbar" class="p-0 mb-4">
                        <li class="active text-uppercase" id="shiping"><strong>Shipping Details</strong></li>
                        <li id="paymentcard" class="text-uppercase"><strong>payment confirm</strong></li>
                    </ul>
                    <div class="progress mb-4">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                    <!-- // -->

                    <!-- ////////////////////////// 1st Fieldset Start ////////////////////////////////// -->
                    <fieldset class="mt-3">
                        <div class="form-card text-start">
                            <div>
                                <div>
                                    <p class="text-danger">* Please Check field details are correct </p>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 text-muted">
                                        <label for="" class="control-label">First Name <i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-sm-4 text-muted">
                                        <input type="text" name="fname" id="fname" class="form-control" value="<?php echo $cusArray["customer_fname"]; ?>" required>
                                        <div class="float-start" id="fnamealert"></div>
                                    </div>
                                    <div class="col-sm-2 text-muted">
                                        <label for="" class="control-label">Last Name <i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-sm-4 text-muted">
                                        <input type="text" name="lname" id="lname" class="form-control" value="<?php echo $cusArray["customer_lname"]; ?>" required>
                                        <div class="float-start" id="lnamealert"></div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-2 text-muted">
                                        <label for="" class="control-label">Email <i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-sm-4 text-muted">
                                        <input type="email" name="email" id="email" class="form-control" value="<?php echo $cusArray["login_email"]; ?>" required>
                                        <div class="float-start" id="emailalert"></div>
                                    </div>
                                    <div class="col-sm-2 text-muted">
                                        <label for="" class="control-label">Contact Number <i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-sm-4 text-muted">
                                        <input type="text" name="contact" id="contat" class="form-control" value="<?php echo $cusArray["customer_cno"]; ?>" required>
                                        <div class="float-start" id="contatalert"></div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-2 text-muted">
                                        <label for="" class="control-label">Postal Code <i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-sm-4 text-muted">
                                        <input type="text" name="postalcode" id="postalcode" class="form-control" value="<?php echo $cusArray["customer_postal_id"]; ?>" maxlength="5" required>
                                        <div class="float-start" id="postalcodealert"></div>
                                    </div>
                                    <div class="col-sm-2 text-muted"></div>
                                    <div class="col-sm-4 text-muted"></div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-2 text-muted">
                                        <label for="" class="control-label">Address <i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-sm-3 text-muted pe-0">
                                        <input type="text" name="addr1" id="addr1" class="form-control " placeholder="Street Address 01" value="<?php echo $cusArray["customer_addr1"]; ?>" required>
                                        <div class="float-start" id="addr1alert"></div>
                                    </div>
                                    <div class="col-sm-3 text-muted pe-0 mt-2 mt-sm-0">
                                        <input type="text" name="addr2" id="addr2" class="form-control " placeholder="Street Address 02" value="<?php echo $cusArray["customer_addr2"]; ?>" required>
                                        <div class="float-start" id="addr2alert"></div>
                                    </div>
                                    <div class="col-sm-3 text-muted pe-0 mt-2 mt-sm-0">
                                        <input type="text" name="addr3" id="addr3" class="form-control" placeholder="City" value="<?php echo $cusArray["customer_addr3"]; ?>" required>
                                        <div class="float-start" id="addr3alert"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <input type="button" id="shippingDetails" name="next" class="next action-button btn button text-white text-uppercase btn-block" value="Next" />
                    </fieldset>
                    <!-- ////////////////////////// 1st Fieldset End ////////////////////////////////// -->

                    <!-- ////////////////////////// 2nd Fieldset Start ////////////////////////////////// -->
                    <fieldset class="mt-3">
                        <div class="row">
                            <div class="col-md-6 text-muted">
                                <div class="card border bg-light">
                                    <div class="card-body">
                                        <h4 class="card-title text-uppercase">Payment Summary</h4>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6 text-end">
                                                <label for="" class="control-label">Total :</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="total" id="total" class="form-control" value="<?php echo sprintf("%.2f", $_POST["productTotal"]); ?>" readonly required>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-md-6 text-end">
                                                <label for="" class="control-label">Shipping Cost :</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="shippingCost" id="shippingCost" class="form-control" value="200.00" readonly required>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-md-6 text-end">
                                                <label for="" class="control-label">Amount Payable :</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="AmtPay" id="AmtPay" class="form-control" value="<?php echo sprintf("%.2f", $_POST["productTotal"] + 200); ?>" readonly required>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 text-muted mt-3 mt-md-0">
                                <div class="card border bg-light">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-md-8 text-start">
                                                <label for="" class="control-label">Name On Card :</label>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-8">
                                                <input type="text" name="nameOfCrd" id="nameOfCrd" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-md-8 text-start">
                                                <label for="" class="control-label">Card Number:</label>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-8">
                                                <input type="number" name="cardNum" id="cardNum" class="form-control" min="1" maxlength="12">
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-md-8 text-start">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label for="" class="control-label">Valid Through:</label>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="number" name="month" id="month" class="form-control" placeholder="mm" value="" maxlength="2" min="1" max="12">
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="number" name="year" id="year" class="form-control" placeholder="yy" value="" min="21" max="30" maxlength="2">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 text-start">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label for="" class="control-label">CVV:</label>
                                                    </div>
                                                    <div class="col-6 col-md-12">
                                                        <input type="number" name="cvv" id="cvv" class="form-control" value="" maxlength="3">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" id="pay" class="action-button btn button text-white text-uppercase btn-block" value="Pay" />
                        <input type="button" name="previous" class="previous action-button-previous btn  text-white text-uppercase btn-block" value="Go Back" />
                    </fieldset>
                    <!-- ////////////////////////// 2nd Fieldset End ////////////////////////////////// -->

                </form>
            </div>
        </div>
    </div>
</div>
<!-- content end -->

<script src="../js/payment.js"></script>

<?php
include_once("footer.php");
?>