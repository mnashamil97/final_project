<?php
include_once("navbar.php");

include_once("../common/redirect.php");
?>

<div class="container-fluid">

    <div class="row mb-3">

        <!-- Top Banner-->
        <div class="col-sm-12 text-center p-5" style="background-image:url('../image/background/1-12.webp');">
            <p class="text-uppercase p-2 m-auto text-white font-weight-lighter" style=" font-family: montserrat,serif; font-size: 40px;">My Profile Dashboard</p>
            <p class="text-uppercase pt-3 pb-0 m-auto text-white font-weight-lighter "><a class="text-decoration-none" style=" font-family: montserrat,serif; color:#db9200" href="home.php">Home</a> &rarr; My Profile Dashboard</p>
        </div>
        <!-- Top Banner End-->

        <div class="col-sm-12 d-flex flex-column flex-sm-row justify-content-sm-around align-items-center">
            <img id="userImg" src="../image/users/<?php echo $_SESSION["customer"]["cusUimg"]; ?>" alt="" class="pt-1" style="width: 220px; height:230px;">
            <h1 class="text-muted p-5">
                <?php echo $_SESSION["customer"]["cusFname"] . " " . $_SESSION["customer"]["cusLname"]; ?>
            </h1>
            <div>
                <a href="editCustomer.php" class="button btn border-0 text-white text-uppercase">
                    <i class="fas fa-user-edit"></i>
                    Edit Info
                </a>
                <a href="changePassword.php" class="btn button btn-warning text-white text-uppercase">
                    <i class="fas fa-key"></i>
                    Edit Password
                </a>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <!-- Nav Tab -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a id="OrderHistoryNav" class="nav-link text-uppercase active" data-bs-toggle="tab" href="#OrderHistory">Order History</a>
                        </li>
                        <li class="nav-item">
                            <a id="FeedBacksNav" class="nav-link text-uppercase" data-bs-toggle="tab" href="#FeedBacks">FeedBacks</a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content mt-2">
                        <!-- View Order Tab -->
                        <div id="OrderHistory" class="container-fluid tab-pane fade show active p-0" style="overflow-x: auto;">
                            <table id="orderRecordsTable" class="table table-hover" style="min-width: 900px;">
                                <thead>
                                    <tr>
                                        <th># Invoice NO</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include_once("../model/order_model.php");
                                    $order_obj = new Order($conn);

                                    include_once("../model/invoice_model.php");
                                    $invoice_obj = new Invoice($conn);

                                    include_once("../model/feedback_modal.php");
                                    $feedback_obj = new Feedback($conn);

                                    $customerId = $_SESSION["customer"]["cusId"];
                                    $orderInfo = $order_obj->giveOrders_ByCustomerId($customerId);

                                    while ($orderArray = $orderInfo->fetch_assoc()) {

                                        $invInfo = $invoice_obj->giveInvoice_ByInvoiceId($orderArray["invoice_invoiceId"]);
                                        $invArray = $invInfo->fetch_assoc();

                                        $feedbackInfo = $feedback_obj->giveFeeback_ByInvoiceId($orderArray["invoice_invoiceId"]);
                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $invArray["invoice_number"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $orderArray["order_date"]; ?>
                                            </td>
                                            <td>
                                                <?php if ($orderArray["order_status"] == 1) {
                                                    echo '<h4 class="text-muted"><i class="fas fa-check-square"></i> Order Placed</h4>';
                                                } else if ($orderArray["order_status"] == 2) {
                                                    echo '<h4 class="text-primary"><i class="fas fa-hourglass-end"></i> Order Processing</h4>';
                                                } else if ($orderArray["order_status"] == 3) {
                                                    echo '<h4 class="text-info"><i class="fas fa-check-double"></i> Order Ready To Delivery</h4>';
                                                } else if ($orderArray["order_status"] == 4) {
                                                    echo '<h4 class="text-warning"><i class="fas fa-shipping-fast"></i> Order On the way</h4>';
                                                } else if ($orderArray["order_status"] == 5) {
                                                    echo '<h4 class="text-success"><i class="fas fa-user-check"></i> Order Delivered</h4>';
                                                } ?>
                                            </td>
                                            <td>
                                                <span data-toggle="tooltip" data-placement="top" title="Details">
                                                    <button type="button" class="btn btn-primary orderHistory" data-invoiceId="<?php echo $orderArray["invoice_invoiceId"]; ?>" data-bs-toggle="modal" data-bs-target="#orderDetailsModal">
                                                        <i class="fas fa-info-circle"></i>
                                                    </button>
                                                </span>

                                                <?php if ($orderArray["order_status"] == 5 && $feedbackInfo->num_rows < 1) {
                                                ?>
                                                    <span data-toggle="tooltip" data-placement="top" title="Feedback">
                                                        <button type="button" class="btn btn-secondary feedbackBtn" data-invoiceId="<?php echo $orderArray["invoice_invoiceId"]; ?>" data-bs-toggle="modal">
                                                            <i class="far fa-comment"></i>
                                                        </button>
                                                    </span>
                                                <?php
                                                } ?>

                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- View Order Tab End -->

                        <!-- Feedback Tab -->
                        <div id="FeedBacks" class="container-fluid tab-pane fade p-0" style="overflow-x: auto;"><br>
                            <table id="feedbackTable" class="table table-hover" style="min-width: 900px;">
                                <thead>
                                    <tr>
                                        <th># Invoice NO</th>
                                        <th>Feedback</th>
                                        <th>Rate</th>
                                        <th>Date / Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $feedbackHistory = $feedback_obj->giveFeedbacks_ByCustomerId($customerId);

                                    while ($feedHistory_array = $feedbackHistory->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $feedHistory_array["invoice_number"]; ?>
                                            </td>
                                            <td style="width: 30%;">
                                                <?php echo $feedHistory_array["feedback_content"]; ?>
                                            </td>
                                            <td style="width: 30%;">
                                                <div class="star-widget float-start pe-3">
                                                    <input type="radio" class="inputs d-none" value="5" <?php if ($feedHistory_array["feedback_starcount"] == 5) {
                                                                                                            echo "checked";
                                                                                                        } ?>>
                                                    <label class="fas fa-star p-0 pe-3"></label>
                                                    <input type="radio" class="inputs d-none" value="4" <?php if ($feedHistory_array["feedback_starcount"] == 4) {
                                                                                                            echo "checked";
                                                                                                        } ?>>
                                                    <label class="fas fa-star p-0 pe-3"></label>
                                                    <input type="radio" class="inputs d-none" value="3" <?php if ($feedHistory_array["feedback_starcount"] == 3) {
                                                                                                            echo "checked";
                                                                                                        } ?>>
                                                    <label class="fas fa-star p-0 pe-3"></label>
                                                    <input type="radio" class="inputs d-none" value="2" <?php if ($feedHistory_array["feedback_starcount"] == 2) {
                                                                                                            echo "checked";
                                                                                                        } ?>>
                                                    <label class="fas fa-star p-0 pe-3"></label>
                                                    <input type="radio" class="inputs d-none" value="1" <?php if ($feedHistory_array["feedback_starcount"] == 1) {
                                                                                                            echo "checked";
                                                                                                        } ?>>
                                                    <label class="fas fa-star p-0 pe-3"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <?php echo $feedHistory_array["feedback_time"]; ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- Feedback Tab End -->

                    </div>
                    <!-- Tab Content End -->
                </div>
            </div>
        </div>
    </div>

</div>
<!-- content end -->

<!-- ////////////////// Modals Start //////////////////// -->

<!-- Order Details  Modal -->
<div class="modal fase" id="orderDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle1" aria-hidden="true" style="overflow-x: auto;">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="min-width: 900px;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #db9200">
                <h5 class="modal-title text-light text-uppercase" id="exampleModalLongTitle1"><i class="fas fa-shipping-fast"></i> &nbsp; View Ordered Details</h5>
                <button type="button" class="btn-close a" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-muted">
                <div id="viewOrderDetails">
                    <!-- ////////////////// Order Detail Content /////////////////////// -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Order Details Modal End -->

<!-- Feedback Modal -->
<div class="modal fase" id="feedBackModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #db9200">
                <h5 class="modal-title text-light text-uppercase" id="exampleModalLongTitle1"><i class="fas fa-comment"></i> &nbsp; feedback</h5>
                <button type="button" class="btn-close a" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-muted">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form id="feedbackForm">
                                    <div class="container">
                                        <div id="feedback" class="pb-2">
                                            <input type="hidden" id="invoiceId" name="invoiceId" value="">
                                            <div class="star-widget float-start pe-3">
                                                <input type="radio" name="rate" id="rate-5" class="inputs d-none" value="5">
                                                <label for="rate-5" class="fas fa-star p-0 pe-3"></label>
                                                <input type="radio" name="rate" id="rate-4" class="inputs d-none" value="4">
                                                <label for="rate-4" class="fas fa-star p-0 pe-3"></label>
                                                <input type="radio" name="rate" id="rate-3" class="inputs d-none" value="3">
                                                <label for="rate-3" class="fas fa-star p-0 pe-3"></label>
                                                <input type="radio" name="rate" id="rate-2" class="inputs d-none" value="2">
                                                <label for="rate-2" class="fas fa-star p-0 pe-3"></label>
                                                <input type="radio" name="rate" id="rate-1" class="inputs d-none" value="1">
                                                <label for="rate-1" class="fas fa-star p-0 pe-3"></label>
                                            </div>
                                        </div>
                                        <br>
                                        <textarea name="comment" id="dis" class="form-control" maxlength="100" style="height: 8em" placeholder="Comment"></textarea>
                                        <br>
                                        <button type="button" id="feedbackSubmit" class="btn button text-white text-uppercase float-right">post</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Feedback Modal End -->

<script src="../js/dashboard.js"></script>

<?php
include_once("footer.php");
?>