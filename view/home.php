<?php
include_once("navbar.php");

$response = isset($_GET["response"]) ? $_GET["response"] : "";

if ($response != "") {
?>
    <script>
        Swal.fire("Thank You !!!", "<?php echo $response; ?>", "success");
    </script>
<?php
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 p-0">
            <!-- carousel code -->
            <div id="carouselExampleIndicators" class="carousel slide d-none d-md-block" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
                </div>
                <div class="carousel-inner" style="height: 100vh" role="listbox">
                    <!-- first slide -->
                    <div class="carousel-item  active">
                        <img src="../image/slider/splash_shop_3_slide_1-1.jpg" alt="Los Angeles" class="w-100 zoomOut">
                        <div class="carousel-caption d-md-block text-dark text-start p-0">
                            <h1 class="mb-md-5 animate__animated animate__bounceIn" style="font-size: 8vw;">
                                THE <strong>FASHION </strong>
                            </h1>
                            <p class="text-justify w-50 animate__animated animate__bounceInRight">
                                Fashion is something we deal with everyday. Even people who say
                                they do not care what they wear choose clothes every morning
                                that say a lot about them and how they feel that day.
                            </p>
                            <br>
                            <a class="button btn btn-md text-white text-uppercase animate__animated animate__bounceInLeft">Shop Here</a>
                        </div>
                    </div>
                    <!-- second slide -->
                    <div class="carousel-item">
                        <img src="../image/slider/splash_shop_3_slide_2.jpg" alt="Los Angeles" class="w-100 zoomIn">
                        <div class="carousel-caption d-md-block text-end p-0">
                            <h1 class="animate__animated animate__bounceIn" style="font-size: 8vw;">
                                AWESOME <br><strong>DESIGNS </strong>
                            </h1>
                            <p class="text-justify ms-auto w-50 animate__animated animate__bounceInLeft">
                                Fashion is something we deal with everyday. Even people who say
                                they do not care what they wear choose clothes every morning that
                                say a lot about them and how they feel that day.
                            </p><br>
                            <a class=" button btn btn-lg border-0 text-white text-uppercase animate__animated animate__zoomInRight">Shop Now</a>
                        </div>
                    </div>
                    <!-- third slide -->
                    <div class="carousel-item">
                        <img src="../image/slider/splash_shop_3_slide_1-1.jpg" alt="Los Angeles" class="w-100 zoomIn">
                        <div class="carousel-caption d-md-block text-center text-dark">
                            <h1 data-animation="animated zoomInLeft" style="font-size: 8vw;">
                                <strong>SELL</strong> ANYTHING
                            </h1>
                            <p class="text-center m-auto w-75" data-animation="animated flipInX">
                                Shopping from home is addictively satisfying and almost dangerously easy. Just a few clicks, some taps on the keyboard, and you have yourself a brand new wardrobe. You basically never need to step foot inside a real store again. Women’s clothing stores come to you instead.
                            </p><br>
                            <a href="" class=" button btn btn-lg border-0 text-white text-uppercase" data-animation="animated lightSpeedIn">Shop Now</a>
                        </div>
                    </div>
                </div>
                <!-- controls -->
                <button class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- image carousel end -->

<!-- content -->
<div class="container-fluid">
    <!--    banner-->
    <div class="row">
        <div class="col-sm-12 text-center p-5" style="background-image:url('../image/background/1-12.webp');">
            <p class="text-uppercase p-2 m-auto text-white font-weight-lighter" style="font-size: 40px;">
                <strong class="fw-bold">Free Shipping </strong>For Order Over Rs 25000
            </p>
        </div>
    </div>
    <!--    banner end -->
    <!--    collection-->
    <div class="row" id="collection">
        <div class="col-sm-6 p-0">
            <div class="card border">
                <div class="card-body" style="background-image: url('../image/background/Men.png'); height:350px; background-position: right;background-repeat: no-repeat;background-size: contain">
                    <h5 class="card-title text-uppercase pt-5 ps-5 font-weight-lighter" style="font-size: 40px;"><strong>Men</strong> Collection</h5>
                    <p class="card-text text-uppercase pt-0 ps-5">select your favorite fashion </p>
                    <a href="productFilter.php?collId=1" class=" button btn border-0 ms-5 text-white text-uppercase">Discover</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 p-0">
            <div class="card border">
                <div class="card-body" style="background-image: url('../image/background/Women.png'); height: 350px;background-position: right;background-repeat: no-repeat;background-size: contain">
                    <h5 class="card-title text-uppercase pt-5 ps-5 font-weight-lighter" style="font-size: 40px;">
                        <strong>Women</strong> Collection
                    </h5>
                    <p class="card-text text-uppercase pt-0 ps-5">select your favorite fashion </p>
                    <a href="productFilter.php?collId=2" class=" button btn border-0 ms-5 text-white text-uppercase">Discover</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 p-0">
            <div class="card border">
                <div class="card-body" style="background-image: url('../image/background/kids.png'); height: 350px;background-position: right;background-repeat: no-repeat;background-size: contain">
                    <h5 class="card-title text-uppercase pt-5 ps-5 font-weight-lighter" style="font-size: 40px;">
                        <strong>Kids</strong> Collection
                    </h5>
                    <p class="card-text text-uppercase pt-0 ps-5">select your favorite fashion </p>
                    <a href="#" class="button btn border-0 ms-5 text-white text-uppercase">Discover</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 p-0">
            <div class="card border">
                <div class="card-body" style="background-image: url('../image/background/accessoires.png'); height: 350px;background-position: right;background-repeat: no-repeat;background-size: contain">
                    <h5 class="card-title text-uppercase pt-5 ps-5 font-weight-lighter" style="font-size: 40px;">
                        <strong>ACCESSOIRES</strong> Collection
                    </h5>
                    <p class="card-text text-uppercase pt-0 ps-5">select your favorite fashion </p>
                    <a href="#" class="button btn border-0 ms-5 text-white text-uppercase">Discover</a>
                </div>
            </div>
        </div>
    </div>
    <!--    collection end-->
</div>

<!-- new arrivals -->
<div class="container-fluid" id="newIn">
    <div class="row mt-3">
        <div class="col-12">
            <h1 class="text-uppercase  fw-bold text-dark text-center" style="font-size: 50px; font-family: montserrat,serif"> What's new</h1>
            <h4 class="text-uppercase font-weight-lighter text-dark text-center" style="font-family: montserrat,serif"> new pieces every week</h4>
            <br>
        </div>
    </div>

    <!-- /////////// New Male Products /////////// -->
    <div class="row">

        <?php
        include_once("../model/product_model.php");
        $product_obj = new Product($conn);

        include_once("../model/stock_model.php");
        $stock_obj = new Stock($conn);

        include_once("../model/size_model.php");
        $size_obj = new Size($conn);

        $maleProducts = $product_obj->giveNew_MaleProducts();

        while ($maleProductsArray = $maleProducts->fetch_assoc()) {

            $imageInfo = $product_obj->giveAllImages_ByProductId($maleProductsArray["product_id"]);
            $imageArray = $imageInfo->fetch_assoc();

            $stockInfo = $stock_obj->giveStockInfo_ByProductId($maleProductsArray["product_id"]);
            $stockArray = $stockInfo->fetch_assoc();

            $sizeInfo = $size_obj->giveSizeInfo_BySizeId($stockArray["size_sizeId"]);
            $sizeArray = $sizeInfo->fetch_assoc();
        ?>

            <div class="col-sm-6 col-md-3 p-3">
                <a href="viewItem.php?productId=<?php echo $maleProductsArray["product_id"]; ?>" type="button" class="text-decoration-none text-muted w-100">
                    <div class="card shadow text-center">
                        <img style="height: 300px;" class="card-img-top zoom img-fluid" src="../image/pro_img/<?php echo $imageArray['img_name']; ?>">
                        <br>
                        <div class="card-body p-1">
                            <p class="productName">
                                <?php echo $maleProductsArray["product_name"]; ?>
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

    <!-- /////////// New Female Products /////////// -->
    <div class="row">

        <?php
        include_once("../model/product_model.php");
        $product_obj = new Product($conn);

        include_once("../model/stock_model.php");
        $stock_obj = new Stock($conn);

        include_once("../model/size_model.php");
        $size_obj = new Size($conn);

        $femaleProducts = $product_obj->giveNew_FemaleProducts();

        while ($femaleProductsArray = $femaleProducts->fetch_assoc()) {

            $imageInfo = $product_obj->giveAllImages_ByProductId($femaleProductsArray["product_id"]);
            $imageArray = $imageInfo->fetch_assoc();

            $stockInfo = $stock_obj->giveStockInfo_ByProductId($femaleProductsArray["product_id"]);
            $stockArray = $stockInfo->fetch_assoc();

            $sizeInfo = $size_obj->giveSizeInfo_BySizeId($stockArray["size_sizeId"]);
            $sizeArray = $sizeInfo->fetch_assoc();
        ?>

            <div class="col-sm-6 col-md-3 p-3">
                <a href="viewItem.php?productId=<?php echo $femaleProductsArray["product_id"]; ?>" type="button" class="text-decoration-none text-muted w-100">
                    <div class="card shadow text-center">
                        <img style="height: 300px;" class="card-img-top zoom img-fluid" src="../image/pro_img/<?php echo $imageArray['img_name']; ?>">
                        <br>
                        <div class="card-body p-1">
                            <p class="productName">
                                <?php echo $femaleProductsArray["product_name"]; ?>
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

</div>
<!-- new arrivals end -->
<!--content end -->

<!-- brands -->
<div class="container-fluid">
    <div class="row p-3">
        <div class="col-sm-12">
            <h1 class="text-uppercase  fw-bold text-dark text-center" style="font-size: 50px; font-family: montserrat,serif"> Brands</h1>
            <h4 class="text-uppercase font-weight-lighter text-dark text-center" style="font-family: montserrat,serif">We offer finest brands in our store</h4>
            <br>
        </div>
        <div class="row">
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mx-auto">
                <div class="card-body">
                    <img class="brand img-fluid" src="../image/brand_img/1.png" alt="">
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card-body">
                    <img class="brand img-fluid" src="../image/brand_img/2.png" alt="">
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card-body">
                    <img class="brand img-fluid" src="../image/brand_img/3.png" alt="">
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card-body">
                    <img class="brand img-fluid" src="../image/brand_img/4.png" alt="">
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card-body">
                    <img class="brand img-fluid" src="../image/brand_img/5.png" alt="">
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card-body">
                    <img class="brand img-fluid" src="../image/brand_img/6.png" alt="">
                </div>
            </div>
        </div>


        <div class="row mt-2">
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card-body">
                    <img class="brand img-fluid" src="../image/brand_img/7.png" alt="">
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card-body">
                    <img class="brand img-fluid" src="../image/brand_img/8.png" alt="">
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card-body">
                    <img class="brand img-fluid" src="../image/brand_img/9.png" alt="">
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card-body">
                    <img class="brand img-fluid" src="../image/brand_img/10.png" alt="">
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card-body">
                    <img class="brand img-fluid" src="../image/brand_img/11.png" alt="">
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card-body">
                    <img class="brand img-fluid" src="../image/brand_img/12.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!--brands end-->

<?php
include_once("footer.php");
?>