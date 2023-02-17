<?php

require_once("../common/connection.php");

class Customer
{
    private $conn;
    private $table = "customers";
    private $table_login = "customer_login";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    protected function getCustomer_infoById($customerId)
    {
        $sql = "SELECT * FROM $this->table c INNER JOIN $this->table_login cl ON c.customer_id = cl.customer_customerId " .
            "WHERE cl.customer_customerId = ?";

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

    protected function getCustomer_infoByEmail($email)
    {
        $sql = "SELECT * FROM $this->table c INNER JOIN $this->table_login cl ON c.customer_id = cl.customer_customerId " .
            "WHERE cl.login_email = ?";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();

            $result = $stmt->get_result();
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    protected function getCustomer_infoByNIC($nic)
    {
        $sql = "SELECT * FROM $this->table c INNER JOIN $this->table_login cl ON c.customer_id = cl.customer_customerId " .
            "WHERE c.customer_nic = ?";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $nic);
            $stmt->execute();

            $result = $stmt->get_result();
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    protected function insertNewCustomer($fname, $lname, $addr1, $addr2, $addr3, $postalId, $gender, $nic, $contact, $uimg, $email, $pw)
    {
        $sql = "CALL insertCustomer(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssssississs", $fname, $lname, $addr1, $addr2, $addr3, $postalId, $gender, $nic, $contact, $uimg, $email, $pw);
            $stmt->execute();

            $result = $stmt->get_result();
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    protected function editCustomer($fname, $lname, $addr1, $addr2, $addr3, $postalId, $gender, $contact, $uimg, $customerId)
    {
        $sql = "UPDATE $this->table SET customer_fname = ?, customer_lname = ?, customer_addr1 = ?, customer_addr2 = ?, customer_addr3 = ?, customer_postal_id = ?, customer_gender = ?, customer_cno = ?, customer_img = ? " .
            "WHERE customer_id = ?";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssssisisi", $fname, $lname, $addr1, $addr2, $addr3, $postalId, $gender, $contact, $uimg, $customerId);
            $stmt->execute();

            $result = true;
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    protected function editPassword($customerId, $newPw)
    {
        $sql = "UPDATE $this->table_login SET login_password = ? WHERE customer_customerId = ?";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("si", $newPw, $customerId);
            $stmt->execute();

            $result = true;
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    ////////////////////// Public Access ///////////////
    public function giveCustomer_infoById($customerId)
    {
        return $this->getCustomer_infoById($customerId);
    }
}
