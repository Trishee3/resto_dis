<?php
require_once '../classes/Product.php';

//get id
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $productId = $_GET['id'];
    $product = new Product();
    $currentProduct = $product->getProductById($productId);
}

//add
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $productName = $_POST['productName'];
    $price = $_POST['price'];
    $available = $_POST['available'];

    $product = new Product();
    $product->addProduct($productName, $price, $available);

    header('Location: ../views/dashboard.php');
    exit();
}

//update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $productId = $_POST['productId'];
    $productName = $_POST['productName'];
    $price = $_POST['price'];
    $available = $_POST['available'];

    $product = new Product();
    $product->updateProduct($productId, $productName, $price, $available);

    header('Location: ../views/dashboard.php');
    exit();
}
