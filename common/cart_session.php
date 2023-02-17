<?php

session_start();

///////////////////// Cart Session /////////////////////
if (isset($_POST["addToCart"])) {

    $productId = $_POST["productId"];
    $sizeId = $_POST["sizeId"];
    $itemId = $_POST["stockId"];
    $productPrice = $_POST["productPrice"];

    if (isset($_SESSION["cart"])) {

        $itemId_array = array_column($_SESSION["cart"], "itemId");

        if (in_array($itemId, $itemId_array)) {

            $findIndex = array_search($itemId, $itemId_array);

            $_SESSION["cart"][$findIndex]["productQty"] += 1;
            $newQty = $_SESSION["cart"][$findIndex]["productQty"];

            $newSubTotal = $newQty * $_SESSION["cart"][$findIndex]["productPrice"];

            $_SESSION["cart"][$findIndex]["subTotal"] = sprintf("%.2f", $newSubTotal);
        } else {
            $item_array = array(
                "itemId" => $itemId,
                "productId" => $productId,
                "sizeId" => $sizeId,
                "productPrice" => $productPrice,
                "productQty" => 1,
                "subTotal" => $productPrice
            );

            array_push($_SESSION["cart"], $item_array);
        }
    } else {
        $_SESSION["cart"] = array();

        $item_array = array(
            "itemId" => $itemId,
            "productId" => $productId,
            "sizeId" => $sizeId,
            "productPrice" => $productPrice,
            "productQty" => 1,
            "subTotal" => $productPrice
        );

        array_push($_SESSION["cart"], $item_array);
    }
}

/////////////////////// Request Handling //////////////////////
$type = isset($_GET["type"]) ? $_GET["type"] : "";

switch ($type) {

    case 'removeItem':

        $itemId = $_POST["itemId"];

        $itemId_array = array_column($_SESSION["cart"], "itemId");
        $findIndex = array_search($itemId, $itemId_array);

        unset($_SESSION["cart"][$findIndex]);

        $_SESSION["cart"] = array_values($_SESSION["cart"]);

        break;

    case 'increaseQty':

        $itemId = $_POST["itemId"];

        $itemId_array = array_column($_SESSION["cart"], "itemId");
        $findIndex = array_search($itemId, $itemId_array);

        $_SESSION["cart"][$findIndex]["productQty"] += 1;
        $newQty = $_SESSION["cart"][$findIndex]["productQty"];

        $newSubTotal = $newQty * $_SESSION["cart"][$findIndex]["productPrice"];

        $_SESSION["cart"][$findIndex]["subTotal"] = sprintf("%.2f", $newSubTotal);

        break;

    case 'decreaseQty':

        $itemId = $_POST["itemId"];

        $itemId_array = array_column($_SESSION["cart"], "itemId");
        $findIndex = array_search($itemId, $itemId_array);

        $_SESSION["cart"][$findIndex]["productQty"] -= 1;
        $newQty = $_SESSION["cart"][$findIndex]["productQty"];

        $newSubTotal = $newQty * $_SESSION["cart"][$findIndex]["productPrice"];

        $_SESSION["cart"][$findIndex]["subTotal"] = sprintf("%.2f", $newSubTotal);

        break;
}
