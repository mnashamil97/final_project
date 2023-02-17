<?php include_once("navbar.php");

include_once("../model/faq_model.php");
$faq_obj = new FAQ($conn);

$faqInfo = $faq_obj->giveAllFAQs();
?>

<div class="container-fluid mb-5">

    <div class="row">
        <div class="col-sm-10 mx-auto">

            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">FAQs</h2>
                </div>
                <div class="card-body">

                    <ol>

                        <?php
                        $count = 1;
                        while ($faqArray = $faqInfo->fetch_assoc()) { ?>
                            <li style="text-decoration: underline; cursor: pointer;" data-bs-toggle="collapse" data-bs-target="#faq<?php echo $count; ?>" aria-expanded="false" aria-controls="collapseExample">
                                <h5>
                                    <?php echo $faqArray["faq_content"]; ?>
                                    <span class="h6 ms-3">
                                        <i class="far fa-clock"></i>
                                        <?php echo date("M j Y g:i A", strtotime($faqArray["faq_time"])); ?>
                                    </span>
                                </h5>
                            </li>
                            <div class="collapse" id="faq<?php echo $count; ?>">
                                <?php echo "<b>Answer</b> -: " . $faqArray["faq_answer"]; ?>
                            </div>
                            <hr>
                        <?php
                            $count++;
                        } ?>

                    </ol>

                </div>
            </div>

        </div>
    </div>

</div>

<?php
include_once("footer.php");
?>