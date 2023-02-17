<?php

require_once("../common/connection.php");

class Size
{
    private $conn;
    private $table = "sizes";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    protected function getSizeInfo_BySizeId($sizeId)
    {
        $sql = "SELECT * FROM $this->table WHERE size_id = ?";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $sizeId);
            $stmt->execute();

            $result = $stmt->get_result();
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    protected function getSizeInfo_ByProductId($productId)
    {
        $sql = "SELECT * FROM $this->table s INNER JOIN product_has_size phs ON s.size_id = phs.size_sizeId " .
            "WHERE phs.product_productId = ?";

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

    ////////////////////// Public Access ///////////////
    public function giveSizeInfo_BySizeId($sizeId)
    {
        return $this->getSizeInfo_BySizeId($sizeId);
    }

    public function giveSizeInfo_ByProductId($productId)
    {
        return $this->getSizeInfo_ByProductId($productId);
    }
}
