<?php
require_once '../classes/Product.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productID = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($productID == 0) {
        // Handle the case where productID is not provided
        exit("Product ID not provided");
    }

    $product = new Product();
    $selectedProduct = $product->getProductById($productID);

    $prodName = isset($_POST['productName']) ? strval($_POST['productName']) : "";
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;
    $selectedDiscount = isset($_POST['discount']) ? $_POST['discount'] : 'none';
    $numOfDiscounts = isset($_POST['numOfDisc']) ? intval($_POST['numOfDisc']) : 0;

    if ($quantity > 0 && $quantity <= $selectedProduct['available']) {
        $subtotal = $quantity * $selectedProduct['price'];

        $discount = 0;

        if ($selectedDiscount === 'sc') {
            $discount = .20;
        } elseif ($selectedDiscount === 'pwd') {
            $discount = .20;
        } elseif ($selectedDiscount === '5blw') {
            $discount = .20;
        }
        if ($numOfDiscounts > 0) {
            $discount *= $numOfDiscounts;
        }

        $total = $subtotal - ($subtotal * $discount);

        $product->processTransaction($productID, $prodName, $quantity, $total);

        header('Location: ../views/menu.php');
        exit();
    } else {
        $errorMessage = 'Invalid quantity or insufficient stock.';
    }
}
?>