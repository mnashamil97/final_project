<?php

session_start();

require_once("../model/order_model.php");

class Order_Controller extends Order
{
    public function createOrder($date, $fname, $lname, $addr1, $addr2, $addr3, $postalId, $contact, $email, $customerId, $invId)
    {
        $result = parent::insertOrder($date, $fname, $lname, $addr1, $addr2, $addr3, $postalId, $contact, $email, $customerId, $invId);

        return $result;
    }

    public function createOrderItems($orderId, $productId, $qty, $unitPrice, $subTotal, $sizeId)
    {
        $result = parent::insertOrderItems($orderId, $productId, $qty, $unitPrice, $subTotal, $sizeId);

        return $result;
    }

    public function selectOrderInfo_ByInvoiceId($invId)
    {
        $result = parent::getOrderInfo_ByInvoiceId($invId);

        return $result;
    }
}

$ordCont_obj = new Order_Controller($conn);

//////////////////////// Switch Requests ///////////////////////
$request = isset($_GET["type"]) ? $_GET["type"] : "";

switch ($request) {

    case 'addNewOrder':

        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $contact = $_POST["contact"];
        $postalId = $_POST["postalcode"];
        $addr1 = $_POST["addr1"];
        $addr2 = $_POST["addr2"];
        $addr3 = $_POST["addr3"];

        $total = $_POST["total"];
        $payAmt = $_POST["AmtPay"];

        include_once("../model/invoice_model.php");
        $invoice_obj = new Invoice($conn);

        $getCount = $invoice_obj->giveInvoiceCount_ByDate();
        $invArray = $getCount->fetch_assoc();

        $count = $invArray["inv_count"];
        $count += 1;

        date_default_timezone_set("Asia/Colombo");
        $currDate = date("Ymd");

        $customerId = $_SESSION["customer"]["cusId"];

        $newInvNum = "INV" . $currDate . "_" . str_pad($count, 4, "0", STR_PAD_LEFT);

        $invId = $invoice_obj->createInvoice($newInvNum, $total, $payAmt, $customerId);

        if ($invId) {

            $date = date("Y-m-d");

            $ordId = $ordCont_obj->createOrder($date, $fname, $lname, $addr1, $addr2, $addr3, $postalId, $contact, $email, $customerId, $invId);

            if ($ordId) {

                include_once("../model/cart_model.php");
                $cart_obj = new Cart($conn);

                $sessId = session_id();

                $cart_obj->deleteCart($sessId);

                $subject = "Your Order Has Been Received !!";

                $body = '
                <div style="padding:16px;">
                <h1 style="padding:16px;">Thank You For Your Order</h1>
                <h2 style="padding:16px;">Hi...' . $fname . ' ' . $lname . '</h2>
                <h3 style="padding:16px;">Just to let you know — we have received your order #' . $newInvNum . ', and it is now being processed :</h3>
                <h4 style="padding:16px; color: gold;">Date : ' . $date . '</h4>
                
                <table style="padding:16px; border: 1px solid black; width: 100%; border-collapse: collapse;">
                <thead>
                 <td style="padding:16px; border: 1px solid black;">Product</td>
                 <td style="padding:16px; border: 1px solid black;">Price</td>
                 <td style="padding:16px; border: 1px solid black;">Quantity</td>
                 <td style="padding:16px; border: 1px solid black;">Subtotal</td>
                </thead>
                
                <tbody>';

                include_once("../model/product_model.php");
                $product_obj = new Product($conn);

                include_once("../model/size_model.php");
                $size_obj = new Size($conn);

                include_once("../model/stock_model.php");
                $stock_obj = new Stock($conn);

                foreach ($_SESSION["cart"] as $key => $value) {

                    $stock_obj->deleteItemCount($value["itemId"], $value["productQty"]);

                    $ordCont_obj->createOrderItems($ordId, $value["productId"], $value["productQty"], $value["productPrice"], $value["subTotal"], $value["sizeId"]);

                    $productInfo = $product_obj->giveProductInfo_ByProductId($value["productId"]);
                    $productArray = $productInfo->fetch_assoc();

                    $sizeInfo = $size_obj->giveSizeInfo_BySizeId($value["sizeId"]);
                    $sizeArray = $sizeInfo->fetch_assoc();

                    $body .= '
                    <tr>
                      <td style="padding:16px; border: 1px solid black;">
                      ' . $productArray["product_name"] . ' Size : ' . $sizeArray["size_name"] . '
                      </td>
                      <td style="padding:16px; border: 1px solid black;">
                      ' . $value["productPrice"] . '
                      </td>
                      <td style="padding:16px; border: 1px solid black;">
                      ' . $value["productQty"] . '
                      </td>
                      <td style="padding:16px; border: 1px solid black;">
                      ' . $value["subTotal"] . '
                      </td>
                    </tr>';
                }

                $body .= '
                <tr>
                 <td colspan="3" style="padding:16px; border: 1px solid black;">Total</td>
                 <td style="padding:16px; border: 1px solid black;">
                 ' . $total . '
                 </td>
                </tr>
                
                <tr>
                 <td colspan="3" style="padding:16px; border: 1px solid black;">Delivery</td>
                 <td style="padding:16px; border: 1px solid black;">200.00</td>
                </tr>
                
                <tr>
                 <td colspan="3" style="padding:16px; border: 1px solid black;">Net Total</td>
                 <td style="padding:16px; border: 1px solid black;">
                 ' . $payAmt . '
                 </td>
                </tr>
                
                </tbody>
                </table>
                </div>';

                include_once("../common/mailConfig.php");
                sendMail($email, $subject, $body);

                unset($_SESSION["cart"]);

                $response = "Your Order Has Been Placed Successfully";

                header("Location: ../view/home.php?response=$response");
            } else {

                $invoice_obj->deleteInvoice($invId);

                $response = "Something Went Wrong. Task Fail";
                $status = "danger";

                header("Location: ../view/payment.php?response=$response&status=$status");
            }
        } else {
            $response = "Something Went Wrong. Task Fail";
            $status = "danger";

            header("Location: ../view/payment.php?response=$response&status=$status");
        }

        break;

    case 'viewOrderDetails':

        $invId = $_GET["invoiceId"];

        $orderInfo = $ordCont_obj->selectOrderInfo_ByInvoiceId($invId);
        $orderArray = $orderInfo->fetch_assoc();

        $orderInfo_2 = $ordCont_obj->selectOrderInfo_ByInvoiceId($invId);
?>

        <div class="row mb-3">
            <div class="col-8 fw-bold">
                <p><i class="fas fa-check"></i> Date and Time : &nbsp;&nbsp; <?php echo $orderArray["invoice_time"]; ?></p>
            </div>
        </div>

        <table class="table fw-bold">
            <thead>
                <tr class="text-center">
                    <td>#</td>
                    <td>Product</td>
                    <td>Product Price</td>
                    <td>Quantity</td>
                    <td class="text-end">Sub Total</td>
                </tr>
            </thead>

            <tbody>
                <?php
                $count = 1;
                while ($orderArray_2 = $orderInfo_2->fetch_assoc()) {
                ?>
                    <tr class="text-center">
                        <td><?php echo $count; ?></td>
                        <td><?php echo $orderArray_2["product_name"]; ?></td>
                        <td><?php echo $orderArray_2["product_price"]; ?></td>
                        <td><?php echo $orderArray_2["product_qty"]; ?></td>
                        <td class="text-end"><?php echo $orderArray_2["sub_total"]; ?></td>
                    </tr>
                <?php
                    $count++;
                }
                ?>

                <tr>
                    <td class="text-center" colspan="4">
                        Delivery Fee
                    </td>
                    <td class="text-end">
                        200.00
                    </td>
                </tr>

                <tr>
                    <td class="text-center" colspan="4">
                        Net Total
                    </td>
                    <td class="text-end">
                        <?php echo $orderArray["invoice_net_total"]; ?>
                    </td>
                </tr>
            </tbody>
        </table>

<?php
        break;
}
