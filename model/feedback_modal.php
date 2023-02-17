<?php

require_once("../common/connection.php");

class Feedback
{
    private $conn;
    private $table = "feedbacks";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    protected function getFeeback_ByInvoiceId($invId)
    {
        $sql = "SELECT * FROM $this->table WHERE invoice_invoiceId = ?";

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

    protected function insertFeedback($content, $strCount, $customerId, $invId)
    {
        $sql = "INSERT INTO $this->table(feedback_content, feedback_starcount, customer_customerId, invoice_invoiceId) " .
            "VALUES(?, ?, ?, ?)";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("siii", $content, $strCount, $customerId, $invId);
            $stmt->execute();

            $result = true;
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    protected function getFeedbacks_ByCustomerId($customerId)
    {
        $sql = "SELECT * FROM $this->table f INNER JOIN invoices i ON f.invoice_invoiceId = i.invoice_id WHERE f.customer_customerId = ?";

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

    ////////////////////// Public Access ///////////////
    public function giveFeeback_ByInvoiceId($invId)
    {
        return $this->getFeeback_ByInvoiceId($invId);
    }

    public function giveFeedbacks_ByCustomerId($customerId)
    {
        return $this->getFeedbacks_ByCustomerId($customerId);
    }
}
