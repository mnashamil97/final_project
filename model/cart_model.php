<?php

require_once("../common/connection.php");

class Cart
{
    private $conn;
    private $table = "cart";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    protected function getCartBy_SessionAndItemId($sessId, $itemId)
    {
        $sql = "SELECT * FROM $this->table WHERE sess_id = ? AND stock_stockId = ?";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("si", $sessId, $itemId);
            $stmt->execute();

            $result = $stmt->get_result();
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    protected function insertNewItem($sessId, $itemId)
    {
        $sql = "INSERT INTO $this->table(sess_id, stock_stockId) VALUES(?, ?)";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("si", $sessId, $itemId);
            $stmt->execute();

            $result = true;
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    protected function increaseItemCount($sessId, $itemId)
    {
        $sql = "UPDATE $this->table SET item_qty = item_qty + 1 WHERE sess_id = ? AND stock_stockId = ?";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("si", $sessId, $itemId);
            $stmt->execute();

            $result = true;
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    protected function decreaseItemCount($sessId, $itemId)
    {
        $sql = "UPDATE $this->table SET item_qty = item_qty - 1 WHERE sess_id = ? AND stock_stockId = ?";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("si", $sessId, $itemId);
            $stmt->execute();

            $result = true;
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    protected function removeItem_FromCart($sessId, $itemId)
    {
        $sql = "DELETE FROM $this->table WHERE sess_id = ? AND stock_stockId = ?";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("si", $sessId, $itemId);
            $stmt->execute();

            $result = true;
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    protected function removeCart($sessId)
    {
        $sql = "DELETE FROM $this->table WHERE sess_id = ?";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $sessId);
            $stmt->execute();

            $result = true;
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    ////////////////// Stock updates /////////////////
    protected function decreaseCount_FromStock($stockId)
    {
        $sql = "UPDATE stocks SET stock_count = stock_count - 1 WHERE stock_id = ?";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $stockId);
            $stmt->execute();

            $result = true;
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    protected function increaseCount_FromStock($stockId)
    {
        $sql = "UPDATE stocks SET stock_count = stock_count + 1 WHERE stock_id = ?";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $stockId);
            $stmt->execute();

            $result = true;
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    ///////////////////// Public Access //////////////////////
    public function deleteCart($sessId)
    {
        return $this->removeCart($sessId);
    }
}
