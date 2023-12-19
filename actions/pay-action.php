<?php
session_start();
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
    $customerName = isset($_POST['customer']) ? strval($_POST['customer']) : "";
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

        //calculate the discount first
        $discountedPrice = $selectedProduct['price'] * $discount;

        //set the number of discounted persons into one(1) if the discount is enabled and the numofdiscount is unset
        if($discount > 0 && $numOfDiscounts === 0){
            $numOfDiscounts = 1;
        }

        //then calculate how many person is discounted
        $finalDiscount = $discountedPrice * $numOfDiscounts;
        
        if($finalDiscount <= 0){
            $finalDiscount = 0;
        }
        $total = $subtotal - $finalDiscount;

        $product->processTransaction($productID, $customerName, $prodName, $quantity, $total, $finalDiscount);
        
        //set success message after successful purchase
        $_SESSION['success_message'] = 'Purchase successful!';
        
        header('Location: ../views/menu.php');
        exit();
    } else {
        $errorMessage = 'Invalid quantity or insufficient stock.';
    }
}
?>