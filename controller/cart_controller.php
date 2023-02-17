<?php

session_start();

require_once("../model/cart_model.php");

class Cart_Controller extends Cart
{
    public function selectCartBy_SessionAndItemId($sessId, $itemId)
    {
        return parent::getCartBy_SessionAndItemId($sessId, $itemId);
    }

    public function createNewItem($sessId, $itemId)
    {
        return parent::insertNewItem($sessId, $itemId);
    }

    public function plusUpdateItemCount($sessId, $itemId)
    {
        return parent::increaseItemCount($sessId, $itemId);
    }

    public function deleteItem_FromCart($sessId, $itemId)
    {
        return parent::removeItem_FromCart($sessId, $itemId);
    }

    public function minusUpdateItemCount($sessId, $itemId)
    {
        return parent::decreaseItemCount($sessId, $itemId);
    }

    //////////////////// Stock Update ////////////////////
    public function minusUpdateCount_FromStock($stockId)
    {
        return parent::decreaseCount_FromStock($stockId);
    }

    public function plusUpdateCount_FromStock($stockId)
    {
        return parent::increaseCount_FromStock($stockId);
    }
}

$cartCont_obj = new Cart_Controller($conn);

//////////////////////// Switch Requests ///////////////////////
$request = isset($_GET["type"]) ? $_GET["type"] : "";

switch ($request) {

    case 'addNewItem':

        $sessId = session_id();
        $itemId = $_POST["itemId"];

        $result = $cartCont_obj->selectCartBy_SessionAndItemId($sessId, $itemId);

        if ($result->num_rows > 0) {
            $result_2 = $cartCont_obj->plusUpdateItemCount($sessId, $itemId);
        } else {
            $result_2 = $cartCont_obj->createNewItem($sessId, $itemId);
        }

        if ($result_2) {
            $cartCont_obj->minusUpdateCount_FromStock($itemId);
        }

        break;

    case 'removeItem':

        $sessId = session_id();
        $itemId = $_POST["itemId"];

        $cartCont_obj->deleteItem_FromCart($sessId, $itemId);

        break;

    case 'decreaseQty':

        $sessId = session_id();
        $itemId = $_POST["itemId"];

        $result = $cartCont_obj->minusUpdateItemCount($sessId, $itemId);

        if ($result) {
            $cartCont_obj->plusUpdateCount_FromStock($itemId);
        }

        break;
}
