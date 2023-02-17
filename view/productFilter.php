<?php
include_once("navbar.php");

$collId = $_GET["collId"];

include_once("../model/product_model.php");
$product_obj = new Product($conn);

$brandInfo = $product_obj->giveBrands_ByCollId($collId);
$collTypeInfo = $product_obj->giveCollType_ByCollId($collId);
$catInfo = $product_obj->giveCategories_ByCollId($collId);
?>

<!-- content -->
<div class="container-fluid">

    <input id="collId" type="hidden" value="<?php echo $collId; ?>">

    <!--  Top  Banner-->
    <div class="row">
        <div class="col-md-12 text-center p-5 pb-5" style="background-image:url('../image/background/1-12.webp');">
            <p class="text-uppercase p-2 m-auto text-white font-weight-lighter" style=" font-family: montserrat,serif; font-size: 40px;">Product Collection</p>
            <p class="text-uppercase pt-3 pb-0 m-auto text-white font-weight-lighter "><a class="text-decoration-none" style=" font-family: montserrat,serif; color:#db9200" href="home.php">Home</a> &rarr; Product Collection</p>
        </div>
    </div>
    <!--  Top Banner End -->

    <div class="row mt-3">
        <!-- Filter Area    -->
        <div class="col-sm-12 col-md-3 text-muted">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-2 ps-3">
                        <div class="col-sm-4 col-md-12">
                            <label class="control-label text-nowrap text-uppercase fw-bold">Brand</label>
                            <hr class="m-0 fw-bold">
                            <input type="radio" class="mt-2" name="brandId" checked value="brand_brandId">
                            <label>ALL</label><br>
                            <?php
                            while ($brandArray = $brandInfo->fetch_assoc()) {
                            ?>
                                <input type="radio" class="mt-2" name="brandId" value="<?php echo $brandArray["brand_id"]; ?>">
                                <label>
                                    <?php echo $brandArray["brand_name"]; ?>
                                </label><br>
                            <?php
                            }
                            ?>
                        </div>

                        <div class="col-sm-4 col-md-12">
                            <label class="control-label text-nowrap text-uppercase fw-bold">Type Of Collection</label>
                            <hr class="m-0 fw-bold">
                            <input type="radio" class="mt-2" name="collTypeId" checked value="collection_type_collectionTypeId">
                            <label>ALL</label><br>
                            <?php
                            while ($CollTypeArray = $collTypeInfo->fetch_assoc()) {
                            ?>
                                <input type="radio" class="mt-2" name="collTypeId" value="<?php echo $CollTypeArray["collection_type_id"]; ?>">
                                <label>
                                    <?php echo $CollTypeArray["collection_type_name"]; ?>
                                </label><br>
                            <?php
                            }
                            ?>
                        </div>

                        <div class="col-sm-4 col-md-12">
                            <label class="control-label text-nowrap text-uppercase fw-bold">Category</label>
                            <hr class="m-0 fw-bold">
                            <input type="radio" class="mt-2" name="catId" checked value="category_categoryId">
                            <label>ALL</label><br>
                            <?php
                            while ($CatArray = $catInfo->fetch_assoc()) {
                            ?>
                                <input type="radio" class="mt-2" name="catId" value="<?php echo $CatArray["category_id"]; ?>">
                                <label>
                                    <?php echo $CatArray["category_name"]; ?>
                                </label><br>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  Filter Area End -->

        <!-- View Content -->
        <div class="col col-md-9 text-muted" style="border-left: outset;" id="content">
            <!-- ////////////////// Filtered Content Displayed Here.... ////////////////////// -->
        </div>
        <!-- View Content End -->
    </div>

</div>
<!-- content end -->

<script src="../js/productFilter.js"></script>

<?php
include_once("footer.php");
?>