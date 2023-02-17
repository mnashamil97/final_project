<?php

require_once("../common/connection.php");

class Order
{
    private $conn;
    private $table = "orders";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    protected function insertOrder($date, $fname, $lname, $addr1, $addr2, $addr3, $postalId, $contact, $email, $customerId, $invId)
    {
        $sql = "INSERT INTO $this->table(order_date, order_cusFname, order_cusLname, order_cusAddr1, order_cusAddr2, order_cusAddr3, order_cusPostalcode, order_cusContact, order_cusEmail, customer_customerId, invoice_invoiceId) " .
            "VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssssssiisii", $date, $fname, $lname, $addr1, $addr2, $addr3, $postalId, $contact, $email, $customerId, $invId);
            $stmt->execute();

            $result = $this->conn->insert_id;
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    protected function insertOrderItems($orderId, $productId, $qty, $unitPrice, $subTotal, $sizeId)
    {
        $sql = "INSERT INTO order_has_product(order_orderId, product_productId, product_qty, product_price, sub_total, size_sizeId) " .
            "VALUES(?, ?, ?, ?, ?, ?)";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iiiddi", $orderId, $productId, $qty, $unitPrice, $subTotal, $sizeId);
            $stmt->execute();

            $result = true;
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    protected function getOrders_ByCustomerId($customerId)
    {
        $sql = "SELECT * FROM $this->table WHERE customer_customerId = ?";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $customerId);
            $stmt->execute();

            $result = $stmt->get_result();
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    protected function getOrderInfo_ByInvoiceId($invId)
    {
        $sql = "SELECT * FROM $this->table ord INNER JOIN invoices inv " .
            "ON ord.invoice_invoiceId = inv.invoice_id INNER JOIN order_has_product ohp " .
            "ON ord.order_id = ohp.order_orderId INNER JOIN products pro " .
            "ON ohp.product_productId = pro.product_id " .
            "WHERE ord.invoice_invoiceId = ?";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $invId);
            $stmt->execute();

            $result = $stmt->get_result();
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    ////////////////////// Public Access ///////////////
    public function giveOrders_ByCustomerId($customerId)
    {
        return $this->getOrders_ByCustomerId($customerId);
    }
}
