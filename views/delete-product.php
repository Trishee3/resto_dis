<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ./login.php');
    exit();
}

require_once '../classes/Product.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $productId = $_GET['id'];
    
    $product = new Product();
    $product->deleteProduct($productId);

    $_SESSION['delete_message'] = 'Product has been deleted!';
    header('Location: products.php');
    exit();
} else {
    echo "Invalid request.";
}
?>
