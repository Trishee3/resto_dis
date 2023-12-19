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
        $result = $this->conn->query("SELECT * FROM transactions ORDER BY transaction_Date DESC");
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

    public function getProductByName($productName)
    {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE product_name = ?");
        $stmt->bind_param("s", $productName);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }

    public function updateAvailability($productName, $newAvailability)
    {
        $stmt = $this->conn->prepare("UPDATE products SET available = available + ? WHERE product_name = ?");
        $stmt->bind_param('is', $newAvailability, $productName);
        $stmt->execute();
        $stmt->close();
    }


    public function addProduct($image, $productName, $price, $available)
    {
        $stmt = $this->conn->prepare("INSERT INTO products (image, product_name, price, available) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssdi", $image, $productName, $price, $available);
        $stmt->execute();
        $stmt->close();
    }

    public function  updateProduct($image, $productId, $productName, $price, $available)
    {
        $stmt = $this->conn->prepare("UPDATE products SET image=?, product_name=?, price=?, available=? WHERE id=?");
        $stmt->bind_param("ssdii", $image, $productName, $price, $available, $productId);
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

    public function processTransaction($productId, $customerName, $productName, $quantity, $totalCost, $discountedAmount)
    {
        $stmt = $this->conn->prepare("UPDATE products SET available = available - ? WHERE id = ?");
        $stmt->bind_param("ii", $quantity, $productId);
        $stmt->execute();
        $stmt->close();

        $stmt = $this->conn->prepare("INSERT INTO transactions (customer_name, product_name, quantity, discount, total_cost, transaction_Date) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssidd", $customerName, $productName, $quantity, $discountedAmount, $totalCost);
        $stmt->execute();
        $stmt->close();
    }

    // for dashboard counts
    public function numOfProducts()
    {
        $stmt = "SELECT COUNT(id) FROM products";
        $result = $this->conn->query($stmt);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['COUNT(id)'];
        }

        return 0;
    }

    public function totalSales()
    {
        $stmt = "SELECT SUM(total_cost) FROM transactions";
        $result = $this->conn->query($stmt);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['SUM(total_cost)'];
        }

        return 0;
    }

    public function activeAccounts()
    {
        $stmt = "SELECT COUNT(id) FROM users";
        $result = $this->conn->query($stmt);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['COUNT(id)'];
        }

        return 0;
    }
}
