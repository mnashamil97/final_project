 <?php

    require_once("../model/faq_model.php");

    class FAQ_Controller extends FAQ
    {
        public function createFAQ($content, $cusName, $cusEmail)
        {
            $result = parent::insertFAQ($content, $cusName, $cusEmail);

            if ($result) {
                $response = "Send Message Successfully";
                $status = "success";
            } else {
                $response = "Something Went Wrong. Task Fail";
                $status = "danger";
            }

            header("Location: ../view/contactus.php?response=$response&status=$status");
        }
    }

    $faqCont_obj = new FAQ_Controller($conn);

    //////////////////////// Switch Requests ///////////////////////
    $request = isset($_GET["type"]) ? $_GET["type"] : "";

    switch ($request) {

        case 'addFAQ':

            $content = $_POST["msg"];
            $cusName = $_POST["cusName"];
            $cusEmail = $_POST["cusEmail"];

            $faqCont_obj->createFAQ($content, $cusName, $cusEmail);

            break;
    }
