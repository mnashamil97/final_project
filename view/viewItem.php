<?php
include_once("navbar.php");

$productId = $_GET["productId"];

include_once("../model/product_model.php");
$product_obj = new Product($conn);

$productInfo = $product_obj->giveProductInfo_ByProductId($productId);
$productArray = $productInfo->fetch_assoc();
?>

<!-- content -->
<div class="container-fluid">
    <!--    banner-->
    <div class="row">
        <div class="col-sm-12 text-center p-5" style="background-image:url('../image/background/1-12.webp');">
            <p class="text-uppercase p-2 m-auto text-white font-weight-lighter" style=" font-family: montserrat,serif; font-size: 40px;">
                <?php echo $productArray["product_name"]; ?>
            </p>
            <p class="text-uppercase pt-3 pb-0 m-auto text-white font-weight-lighter "><a class="text-decoration-none" style=" font-family: montserrat,serif; color:#db9200" href="home.php">Home</a> &rarr; Product</p>
        </div>
    </div>
    <!--    banner end -->

    <div class="row mt-3 mb-3">

        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12">&nbsp;</div>
            </div>
            <form id="addToCartForm" method="POST" action="viewItem.php?productId=<?php echo $productId; ?>">

                <div class="row ps-5">

                    <div class="col-md-7 col-lg-6 text-muted h-100">
                        <div class="clearfix">
                            <div class="gallery d-flex justify-content-center">

                                <!-- ///// Previews ///// -->
                                <div class="previews d-none d-sm-inline-block">

                                    <?php
                                    $imgInfo = $product_obj->giveAllImages_ByProductId($productId);

                                    $imgInfo_2 = $product_obj->giveAllImages_ByProductId($productId);
                                    $imgArray_2 = $imgInfo_2->fetch_assoc();

                                    while ($imgArray = $imgInfo->fetch_assoc()) {
                                    ?>
                                        <a class="change" data-imgName="../image/pro_img/<?php echo $imgArray['img_name']; ?>">
                                            <img src="../image/pro_img/<?php echo $imgArray['img_name']; ?>" style="width: 70px; height:90px;" alt="">
                                        </a>
                                    <?php } ?>
                                </div>

                                <!-- ///// Main Image ///// -->
                                <a id="mainImage" href="../image/pro_img/<?php echo $imgArray_2['img_name']; ?>" data-fancybox data-width="420" data-height="600" class="full d-block" style="width: 350px;">
                                    <img src="../image/pro_img/<?php echo $imgArray_2['img_name']; ?>" class="w-100 h-100" />
                                </a>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 col-lg-6 text-muted">
                        <div class="row mb-1">
                            <div class="col col-sm-12">
                                <label for="" class="control-label text-uppercase fw-bolder">
                                    <h2>
                                        <?php echo $productArray["product_name"]; ?>
                                    </h2>
                                </label>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-6 col-md-4">
                                <label for="" class="control-label text-uppercase">
                                    <h5>Price </h5>
                                </label>
                            </div>
                            <div class="col-6 col-md-8">
                                <label for="" class="control-label">
                                    <h5 id="setPrice">
                                        <!-- //// Product Sell Price //// -->
                                    </h5>
                                </label>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-6 col-md-4">
                                <label for="" class="control-label text-uppercase"> Brand </label>
                            </div>
                            <div class="col-6 col-md-8">
                                <label for="" class="control-label"> :
                                    <?php echo $productArray["brand_name"]; ?>
                                </label>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-6 col-md-4">
                                <label for="" class="control-label text-uppercase"> Collection </label>
                            </div>
                            <div class="col-6 col-md-8">
                                <label for="" class="control-label"> :
                                    <?php echo $productArray["collection_name"]; ?>
                                </label>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-6 col-md-4">
                                <label for="" class="control-label text-uppercase"> Collection Type </label>
                            </div>
                            <div class="col-6 col-md-8">
                                <label for="" class="control-label"> :
                                    <?php echo $productArray["collection_type_name"]; ?>
                                </label>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-6 col-md-4">
                                <label for="" class="control-label text-uppercase"> Category </label>
                            </div>
                            <div class="col-6 col-md-8">
                                <label for="" class="control-label"> :
                                    <?php echo $productArray["category_name"]; ?>
                                </label>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-6 col-md-4">
                                <label for="" class="control-label text-uppercase"> Size </label>
                            </div>
                            <div class="col-6 col-md-8">
                                <select name="sizeId" id="sizeId" class="form-control w-75" required>
                                    <option value="">Select Size</option>
                                    <?php
                                    include_once("../model/size_model.php");
                                    $size_obj = new Size($conn);

                                    $avlSizesInfo = $size_obj->giveSizeInfo_ByProductId($productId);

                                    while ($avlSizesArray = $avlSizesInfo->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $avlSizesArray['size_id']; ?>">
                                            <?php echo $avlSizesArray['size_name']; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <input type="hidden" name="productId" id="productId" value="<?php echo $productId; ?>">
                                <input type="hidden" name="productPrice" id="productPrice" value="">
                                <input type="hidden" id="stockId" name="stockId">

                                <button type="submit" class="btn button text-white text-uppercase w-50 addToCart" id="addToCart" name="addToCart"> Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>

</div>
<!-- content end -->

<script src="../js/viewItem.js"></script>

<?php
include_once("footer.php");
?>