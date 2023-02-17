<?php
include_once("navbar.php");

$response = isset($_GET["response"]) ? $_GET["response"] : "";
$status = isset($_GET["status"]) ? $_GET["status"] : "";
?>

<!-- Top Content -->
<div class="container-fluid">
    <!-- Top Banner-->
    <div class="row">
        <div class="col-sm-12 text-center p-5" style="background-image:url('../image/background/1-12.webp');">
            <p class="text-uppercase p-2 m-auto text-white font-weight-lighter" style=" font-family: montserrat,serif; font-size: 40px;">Contact Us</p>
            <p class="text-uppercase pt-3 pb-0 m-auto text-white font-weight-lighter ">
                <a class="text-decoration-none" style=" font-family: montserrat,serif; color:#db9200" href="home.php">Home</a> &rarr; Contact Us
            </p>
        </div>
    </div>
    <!-- Top Banner End -->

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

    <!-- Contact Info Row -->
    <div class="row mt-3">
        <div class="col-sm-6 col-md-3 text-center h-100">
            <br>
            <h3 style="color: #db9200"><i class="fas fa-map-marker-alt"></i></h3>
            <br>
            <h3>OUR ADDRESS</h3>
            <p>
                92/c, Raddoluwa,<br>
                Kotugoda.<br>
                Sri lanka
            </p>
        </div>
        <div class="col-sm-6 col-md-3 text-center" style="height: 100%">
            <br>
            <h3 style="color: #db9200"><i class="fas fa-phone-alt"></i></h3>
            <br>
            <h3>OUR PHONES</h3>
            <p>
                +94 763 669 100<br>
                +94 714 349 100
            </p>
        </div>
        <div class="col-sm-6 col-md-3 text-center" style="height: 100%">
            <br>
            <h3 style="color: #db9200"><i class="fas fa-clock"></i></i></h3>
            <br>
            <h3>WORKING HOURS</h3>
            <p>
                Monday - Friday : 9:00 - 22:00<br>
                Saturday : 11:00 - 20:00<br>
                Sunday : 11:00 - 17:00
            </p>
        </div>
        <div class="col-sm-6 col-md-3 text-center" style="height: 100%">
            <br>
            <h3 style="color: #db9200"><i class="fas fa-envelope"></i></h3>
            <br>
            <h3>EMAIL ADDRESS</h3>
            <p>
                support@bosaratextile.lk<br>
                info@bosaratextile.lk
            </p>
        </div>
    </div>
    <!-- Contact Info Row -->

    <!-- Location Map -->
    <div class="row mt-3">
        <div class="col-md-12 p-0 m-0">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63343.58313796452!2d79.89657368736327!3d7.129010186752431!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2f11d65cd8359%3A0xdbbf3e328d826558!2sBosara%20Brand!5e0!3m2!1sen!2slk!4v1603951652925!5m2!1sen!2slk" width="100%" height="600" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
    </div>

    <!-- Location Map End -->
</div>
<!-- Top Content End -->

<!-- Bottom Content -->
<div class="container">
    <!-- Send us Form Start -->
    <div class="row mt-4">
        <div class="col-md-6">
            <h1 class="text-start">ASK YOUR QUESTION</h1>
            <p class="text-uppercase text-start">Get in contact with us by filling out our contact form</p>
            <div>
                <form action="../controller/faq_controller.php?type=addFAQ" method="POST">
                    <div class="form-row">
                        <div class="col-lg-8">
                            <input type="text" class="form-control" value="" placeholder="Name*" id="cusName" name="cusName" autocomplete="off" required>
                        </div>
                        <div class="col-lg-8 mt-2">
                            <input type="email" class="form-control" value="" placeholder="Email*" id="cusEmail" name="cusEmail" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <textarea class="form-control" rows="10" placeholder="Type message.." name="msg" required></textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <button type="submit" class="button btn btn-block border-0 text-white text-uppercase">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <img src="../image/background/contact_us1.jpg" class="h-100 w-100 rounded" alt="">
        </div>
    </div>

    <div>&nbsp;</div>
</div>
<!-- Bottom Content End -->

<script>
    document.title = "BOSARA TEXTILE | Contact Us";
</script>

<?php
include_once("footer.php");
?>