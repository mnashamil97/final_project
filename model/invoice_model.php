<?php

require_once("../common/connection.php");

class Invoice
{
    private $conn;
    private $table = "invoices";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    protected function getInvoice_ByInvoiceId($invId)
    {
        $sql = "SELECT * FROM $this->table WHERE invoice_id = ?";

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

    protected function getInvoiceCount_ByDate()
    {
        $sql = "SELECT COUNT(invoice_id) AS inv_count FROM $this->table WHERE DATE(invoice_time) = DATE(CURRENT_TIMESTAMP)";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->get_result();
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    protected function insertInvoice($invNum, $total, $payAmt, $customerId)
    {
        $sql = "INSERT INTO $this->table(invoice_number, invoice_total, invoice_net_total, customer_customerId) " .
            "VALUES(?, ?, ?, ?)";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sddi", $invNum, $total, $payAmt, $customerId);
            $stmt->execute();

            $result = $this->conn->insert_id;
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    protected function removeInvoice($invId)
    {
        $sql = "DELETE FROM $this->table WHERE invoice_id = ?";

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
    public function giveInvoiceCount_ByDate()
    {
        return $this->getInvoiceCount_ByDate();
    }

    public function createInvoice($invNum, $total, $payAmt, $customerId)
    {
        return $this->insertInvoice($invNum, $total, $payAmt, $customerId);
    }

    public function deleteInvoice($invId)
    {
        return $this->removeInvoice($invId);
    }

    public function giveInvoice_ByInvoiceId($invId)
    {
        return $this->getInvoice_ByInvoiceId($invId);
    }
}
