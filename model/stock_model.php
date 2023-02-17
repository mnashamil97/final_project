<?php

require_once("../common/connection.php");

class Stock
{
    private $conn;
    private $table = "stocks";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    protected function getStockInfo_ByProductId($productId)
    {
        $sql = "SELECT * FROM $this->table WHERE product_productId = ?";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $productId);
            $stmt->execute();

            $result = $stmt->get_result();
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    protected function getStock_ByProductAndSizeId($productId, $sizeId)
    {
        $sql = "SELECT * FROM $this->table WHERE product_productId = ? AND size_sizeId = ?";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $productId, $sizeId);
            $stmt->execute();

            $result = $stmt->get_result();
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    protected function getStock_ByStockId($stockId)
    {
        $sql = "SELECT * FROM $this->table WHERE stock_id = ?";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $stockId);
            $stmt->execute();

            $result = $stmt->get_result();
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    protected function removeItemCount($stockId, $qty)
    {
        $sql = "UPDATE $this->table SET stock_count = stock_count - ? WHERE stock_id = ?";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $qty, $stockId);
            $stmt->execute();

            $result = true;
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    ////////////////////// Public Access ///////////////
    public function giveStockInfo_ByProductId($productId)
    {
        return $this->getStockInfo_ByProductId($productId);
    }

    public function deleteItemCount($stockId, $qty)
    {
        return $this->removeItemCount($stockId, $qty);
    }
}
