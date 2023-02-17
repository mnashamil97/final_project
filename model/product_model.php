<?php

require_once("../common/connection.php");

class Product
{
    private $conn;
    private $table = "products";
    private $table_image = "product_image";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    protected function getNew_MaleProducts()
    {
        $sql = "SELECT * FROM $this->table WHERE collection_collectionId = 1 ORDER BY product_id DESC LIMIT 4";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->get_result();
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    protected function getNew_FemaleProducts()
    {
        $sql = "SELECT * FROM $this->table WHERE collection_collectionId = 2 ORDER BY product_id DESC LIMIT 4";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->get_result();
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    protected function getAllImages_ByProductId($productId)
    {
        $sql = "SELECT * FROM $this->table_image WHERE product_productId = ?";

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

    protected function getBrands_ByCollId($collId)
    {
        $sql = "SELECT p.brand_brandId, b.brand_id, b.brand_name FROM $this->table p, brands b " .
            "WHERE p.brand_brandId = b.brand_id " .
            "AND p.collection_collectionId = ? GROUP BY b.brand_id";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $collId);
            $stmt->execute();

            $result = $stmt->get_result();
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    protected function getCollType_ByCollId($collId)
    {
        $sql = "SELECT p.collection_type_collectionTypeId, ct.collection_type_id, ct.collection_type_name FROM $this->table p, collection_types ct " .
            "WHERE p.collection_type_collectionTypeId = ct.collection_type_id " .
            "AND p.collection_collectionId = ? GROUP BY ct.collection_type_id";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $collId);
            $stmt->execute();

            $result = $stmt->get_result();
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    protected function getCategories_ByCollId($collId)
    {
        $sql = "SELECT p.category_categoryId, c.category_id, c.category_name FROM $this->table p, categories c " .
            "WHERE p.category_categoryId = c.category_id " .
            "AND p.collection_collectionId = ? GROUP BY c.category_id";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $collId);
            $stmt->execute();

            $result = $stmt->get_result();
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    protected function filterProducts($collId, $brandId, $collTypeId, $catId)
    {
        $sql = "SELECT * FROM $this->table WHERE brand_brandId = $brandId AND " .
            "collection_type_collectionTypeId = $collTypeId AND " .
            "category_categoryId = $catId AND " .
            "collection_collectionId = ?";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $collId);
            $stmt->execute();

            $result = $stmt->get_result();
        } catch (Error $e) {
            $result = false;
        }

        return $result;
    }

    protected function getProductInfo_ByProductId($productId)
    {
        $sql = "SELECT * FROM $this->table p " .
            "INNER JOIN brands b ON p.brand_brandId = b.brand_id " .
            "INNER JOIN categories c ON p.category_categoryId = c.category_id " .
            "INNER JOIN collections cl ON p.collection_collectionId = cl.collection_id " .
            "INNER JOIN collection_types ct ON p.collection_type_collectionTypeId = ct.collection_type_id " .
            "AND p.product_id = ?";

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
    public function giveNew_MaleProducts()
    {
        return $this->getNew_MaleProducts();
    }

    public function giveNew_FemaleProducts()
    {
        return $this->getNew_FemaleProducts();
    }

    public function giveAllImages_ByProductId($productId)
    {
        return $this->getAllImages_ByProductId($productId);
    }

    public function giveBrands_ByCollId($collId)
    {
        return $this->getBrands_ByCollId($collId);
    }

    public function  giveCollType_ByCollId($collId)
    {
        return $this->getCollType_ByCollId($collId);
    }

    public function giveCategories_ByCollId($collId)
    {
        return $this->getCategories_ByCollId($collId);
    }

    public function giveProductInfo_ByProductId($productId)
    {
        return $this->getProductInfo_ByProductId($productId);
    }
}
