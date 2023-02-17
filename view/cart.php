<?php
include_once("navbar.php");
?>

<!-- content -->
<div class="container-fluid">
    <!--    banner-->
    <div class="row">
        <div class="col-md-12 text-center p-5" style="background-image:url('../image/background/1-12.webp');">
            <p class="text-uppercase p-2 m-auto text-white font-weight-lighter" style=" font-family: montserrat,serif; font-size: 40px;">My Cart</p>
            <p class="text-uppercase pt-3 pb-0 m-auto text-white font-weight-lighter "><a class="text-decoration-none" style=" font-family: montserrat,serif; color:#db9200" href="home.php">Home</a> &rarr; My Cart</p>
        </div>
    </div>
    <!--    banner end -->

    <div class="row">

        <!-- cart -->
        <div class="col-sm-12 text-muted p-3">

            <?php if (!empty($_SESSION["cart"])) { ?>
                <form action="payment.php" method="POST">

                    <!-- Cart Table Start -->
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-start text-muted text-uppercase">Product</th>
                                <th class="text-center text-muted text-uppercase">Price</th>
                                <th class="text-center text-muted text-uppercase">Quantity</th>
                                <th class="text-center text-muted text-uppercase">SubTotal</th>
                                <th class="text-center text-danger text-uppercase  fw-bold "><i class="fa fa-times text-danger"></i></th>
                            </tr>
                        </thead>
                        <tbody id="invoice">

                            <?php

                            include_once("../model/product_model.php");
                            $product_obj = new Product($conn);

                            include_once("../model/size_model.php");
                            $size_obj = new Size($conn);

                            $total = 0;

                            foreach ($_SESSION["cart"] as $key => $value) {

                                $productId = $value["productId"];
                                $sizeId = $value["sizeId"];

                                $productInfo = $product_obj->giveProductInfo_ByProductId($productId);
                                $productArray = $productInfo->fetch_assoc();

                                $imageInfo = $product_obj->giveAllImages_ByProductId($productId);
                                $imageArray = $imageInfo->fetch_assoc();

                                $sizeInfo = $size_obj->giveSizeInfo_BySizeId($sizeId);
                                $sizeArray = $sizeInfo->fetch_assoc();

                            ?>
                                <tr>
                                    <td class="text-start text-muted text-uppercase fw-bold">
                                        <img src="../image/pro_img/<?php echo $imageArray["img_name"]; ?>" style="width: 100px; height:120px;" class="me-3">
                                        <?php echo $productArray["product_name"] . " || " . $sizeArray["size_name"]; ?>
                                    </td>
                                    <td class="pt-5">
                                        <input class="form-control-plaintext text-center text-muted" type="text" readonly value="<?php echo $value["productPrice"]; ?>">
                                    </td>
                                    <td class="pt-5">
                                        <div class="input-group">
                                            <span class="btn input-group-text increaseProd" data-itemId="<?php echo $value["itemId"]; ?>">
                                                <i class="fas fa-plus"></i>
                                            </span>
                                            <input style="width: 60px;" class="form-control bg-white text-center text-muted prodQty" type="text" readonly value="<?php echo $value["productQty"]; ?>">

                                            <span class="btn input-group-text decreaseProd" data-itemId="<?php echo $value["itemId"]; ?>" data-prodQty="<?php echo $value["productQty"]; ?>">
                                                <i class="fas fa-minus"></i>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="pt-5">
                                        <input class="form-control-plaintext text-center text-muted" type="text" readonly value="<?php echo $value["subTotal"]; ?>">
                                    </td>
                                    <td class="pt-5">
                                        <span class="remove" style="cursor: pointer;" data-itemId="<?php echo $value["itemId"]; ?>">
                                            <i class="fas fa-times text-danger"></i>
                                        </span>
                                    </td>
                                </tr>
                            <?php
                                $total += $value["subTotal"];
                            } ?>

                        </tbody>
                    </table>
                    <!-- cart table end -->


                    <!-- cart footer -->
                    <div class="row mt-3">

                        <div class="col-md-8">
                            <table class="table table-responsive-* table-bordered">
                                <tbody class="fw-bold">
                                    <tr>
                                        <td class="text-muted text-uppercase w-50 pt-2">total (rs)</td>
                                        <td>
                                            <input type="text" class="form-control-plaintext text-start text-muted text-uppercase w-50" name="productTotal" readonly id="total" value="<?php echo sprintf("%.2f", $total); ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted text-uppercase">Delivery Fee (rs)</td>
                                        <td>
                                            <input type="text" class="form-control-plaintext text-start text-muted text-uppercase w-50" readonly id="shipping" value="200.00" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted text-uppercase">Payable amount (rs)</td>
                                        <td>
                                            <input type="text" class="form-control-plaintext a  text-start text-muted text-uppercase w-50" name="productPayableAmt" readonly id="payableAmt" value="<?php echo sprintf("%.2f", $total + 200); ?>" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <button class="btn button text-white text-uppercase btn-block" name="checkout">
                                <i class="far fa-check-circle"></i> &nbsp;Proceed to checkout</button>
                        </div>
                    </div>
                    <!-- cart footer end -->

                </form>
            <?php } else { ?>

                <div class="p-5" style="height: 50vh;">
                    <h1 class="text-center fw-bold text-muted">
                        Your cart is empty...! <i class="fas fa-smile-beam"></i>
                    </h1>
                </div>

            <?php } ?>

        </div>
        <!-- cart end-->

    </div>
</div>
<!-- content end -->

<script src="../js/cartPage.js"></script>

<?php
include_once("footer.php");
?>