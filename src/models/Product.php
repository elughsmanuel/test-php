<?php
class Product {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createProduct($name, $description, $price, $category, $quantity) {
        $sql = "INSERT INTO products (
            name, 
            description, 
            price, 
            category, 
            quantity
        ) VALUES (
            '$name', 
            '$description', 
            '$price', 
            '$category', 
            '$quantity'
        )";
        return $this->conn->query($sql);
    }

    
    public function getProductById($id) {
        $result = $this->conn->query("SELECT * FROM products WHERE id = $id");
        return $result->fetch_assoc();
    }

    public function getAllProducts() {
        $result = $this->conn->query("SELECT * FROM products");
        $products = array();
    
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    
        return $products;
    }
}

?>
