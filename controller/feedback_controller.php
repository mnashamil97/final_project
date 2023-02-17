<?php

session_start();

require_once("../model/feedback_modal.php");

class Feedback_Controller extends Feedback
{
    public function createFeedback($content, $strCount, $customerId, $invId)
    {
        $result = parent::insertFeedback($content, $strCount, $customerId, $invId);

        if ($result) {
            $response = 1;
        } else {
            $response = 0;
        }

        echo $response;
    }
}

$feedCont_obj = new Feedback_Controller($conn);

//////////////////////// Switch Requests ///////////////////////
$request = isset($_GET["type"]) ? $_GET["type"] : "";

switch ($request) {

    case 'addFeedback':

        $content = $_POST["comment"];
        $strCount = $_POST["rate"];
        $invId = $_POST["invoiceId"];
        $customerId = $_SESSION["customer"]["cusId"];

        $feedCont_obj->createFeedback($content, $strCount, $customerId, $invId);

        break;
}
