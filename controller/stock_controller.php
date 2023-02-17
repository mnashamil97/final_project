<?php

require_once("../model/stock_model.php");

class Stock_Controller extends Stock
{
    public function selectStock_ByProductAndSizeId($productId, $sizeId)
    {
        $result = parent::getStock_ByProductAndSizeId($productId, $sizeId);

        if ($result->num_rows > 0) {
            $response = $result->fetch_assoc();
        } else {
            $response = "error";
        }

        echo json_encode($response);
    }

    public function selectStock_ByStockId($stockId)
    {
        $result = parent::getStock_ByStockId($stockId);

        if ($result->num_rows > 0) {
            $response = $result->fetch_assoc();
        } else {
            $response = "error";
        }

        echo json_encode($response);
    }
}

$stockCont_obj = new Stock_Controller($conn);

//////////////////////// Switch Requests ///////////////////////
$request = isset($_GET["type"]) ? $_GET["type"] : "";

switch ($request) {

    case 'getStock_bySizeAndProduct':

        $productId = $_GET["prodId"];
        $sizeId = $_GET["sizeId"];

        $stockCont_obj->selectStock_ByProductAndSizeId($productId, $sizeId);

        break;

    case 'getStock_ByStockId':

        $stockId = $_GET["itemId"];

        $stockCont_obj->selectStock_ByStockId($stockId);

        break;
}
