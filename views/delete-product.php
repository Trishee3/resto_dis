<?php
require_once '../classes/Product.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $productId = $_GET['id'];
    
    $product = new Product();
    $product->deleteProduct($productId);

    header('Location: dashboard.php');
    exit();
} else {
    echo "Invalid request.";
}
?>
