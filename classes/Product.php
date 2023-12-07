<?php

require_once 'Database.php';
class Product
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAllProducts()
    {
        $result = $this->conn->query("SELECT * FROM products");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllSales()
    {
        $result = $this->conn->query("SELECT * FROM transactions");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductById($productId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }

    public function addProduct($productName, $price, $available)
    {
        $stmt = $this->conn->prepare("INSERT INTO products (product_name, price, available) VALUES (?, ?, ?)");
        $stmt->bind_param("sdi", $productName, $price, $available);
        $stmt->execute();
        $stmt->close();
    }

    public function  updateProduct($productId, $productName, $price, $available)
    {
        $stmt = $this->conn->prepare("UPDATE products SET product_name=?, price=?, available=? WHERE id=?");
        $stmt->bind_param("sdii", $productName, $price, $available, $productId);
        $stmt->execute();
        $stmt->close();
    }

    public function deleteProduct($productId)
    {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $stmt->close();
    }

    public function processTransaction($productId, $productName, $quantity, $totalCost)
    {
        $stmt = $this->conn->prepare("UPDATE products SET available = available - ? WHERE id = ?");
        $stmt->bind_param("ii", $quantity, $productId);
        $stmt->execute();
        $stmt->close();

        $stmt = $this->conn->prepare("INSERT INTO transactions (product_name, quantity, total_cost, transaction_Date) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sid", $productName, $quantity, $totalCost);
        $stmt->execute();
        $stmt->close();
    }
}
