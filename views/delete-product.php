<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ./login.php');
    exit();
}

if ($_SESSION['isadmin'] !== 1) {
    header('Location: 403.php');
    exit();
}

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
