<?php

require_once("../model/product_model.php");

class Product_Controller extends Product
{
    public function giveFilterProducts($collId, $brandId, $collTypeId, $catId)
    {
        $result = parent::filterProducts($collId, $brandId, $collTypeId, $catId);

        return $result;
    }
}

$prodCont_obj = new Product_Controller($conn);

//////////////////////// Switch Requests ///////////////////////
$request = isset($_GET["type"]) ? $_GET["type"] : "";

switch ($request) {

    case 'filterProducts':

        $collId = $_GET["collId"];
        $brandId = $_GET["brandId"];
        $collTypeId = $_GET["collTypeId"];
        $catId = $_GET["catId"];

        $productInfo = $prodCont_obj->giveFilterProducts($collId, $brandId, $collTypeId, $catId);

        if ($productInfo->num_rows > 0) {
?>

            <div class="row">

                <?php

                include_once("../model/stock_model.php");
                $stock_obj = new Stock($conn);

                include_once("../model/size_model.php");
                $size_obj = new Size($conn);

                while ($productArray = $productInfo->fetch_assoc()) {

                    $imageInfo = $prodCont_obj->giveAllImages_ByProductId($productArray["product_id"]);
                    $imageArray = $imageInfo->fetch_assoc();

                    $stockInfo = $stock_obj->giveStockInfo_ByProductId($productArray["product_id"]);
                    $stockArray = $stockInfo->fetch_assoc();

                    $sizeInfo = $size_obj->giveSizeInfo_BySizeId($stockArray["size_sizeId"]);
                    $sizeArray = $sizeInfo->fetch_assoc();
                ?>

                    <div class="col-sm-6 col-md-4 p-3">
                        <a href="viewItem.php?productId=<?php echo $productArray["product_id"]; ?>" type="button" class="text-decoration-none text-muted w-100">
                            <div class="card shadow text-center">
                                <img style="height: 300px;" class="card-img-top zoom img-fluid" src="../image/pro_img/<?php echo $imageArray['img_name']; ?>">
                                <br>
                                <div class="card-body p-1">
                                    <p class="productName">
                                        <?php echo $productArray["product_name"]; ?>
                                    </p>
                                    <p class="productName">
                                        <?php echo "Size : " . $sizeArray["size_name"]; ?>
                                    </p>
                                    <p class="productName">
                                        <?php echo "Stock Price : " . $stockArray["stock_sell_price"]; ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>

                <?php
                }
                ?>

            </div>

        <?php
        } else {
        ?>

            <div class="row">
                <div class="col">
                    <h2 class="text-danger text-center">Product Not Found</h2>
                </div>
            </div>

<?php
        }

        break;
}
