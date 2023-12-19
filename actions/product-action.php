<?php
session_start();
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

    $existingProduct = new Product();
    $existingProductName = $existingProduct->getProductByName($productName);

    $target_dir = "../assets/uploads/productImage/";
    $target_file = $target_dir . basename($_FILES['image']['name']);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES['image']['tmp_name']);

    //check if the inputted product name match with existing data in database
    if ($existingProductName) {

        //add the inputted available on existing product
        $existProduct = new Product();
        $existProduct->updateAvailability($productName, $available);
        $_SESSION['success_message'] = "The product available has been successfuly added on the <strong class='text-uppercase'>".$productName."</strong> product!";
    } else {
        if ($check !== false) {
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            if (in_array($imageFileType, $allowedExtensions)) {
                move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

                $product = new Product();
                $product->addProduct($target_file, $productName, $price, $available);

                $_SESSION['success_message'] = 'New product was added!';
            } else {
                $_SESSION['error_message'] = 'Sorry only JPG, JPEG, and PNG files are allowed!';
            }
        } else {
            $_SESSION['error_message'] = 'File is not an image!';
        }
    }

    header('Location: ../views/products.php');
    exit();
}

//update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $productId = $_POST['productId'];
    $productName = $_POST['productName'];
    $price = $_POST['price'];
    $available = $_POST['available'];

    $target_dir = "../assets/uploads/productImage/";
    $target_file = $target_dir . basename($_FILES['image']['name']);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES['image']['tmp_name']);

    // Retrieve the existing product details
    $existingProduct = new Product();
    $existingData = $existingProduct->getProductById($productId);

    // Check if there are changes
    if (
        $target_file === $existingData['image'] &&
        $productName === $existingData['product_name'] &&
        $price === (string)$existingData['price'] &&
        $available === (string)$existingData['available']
    ) {
        // No changes, redirect back without updating
        $_SESSION['update_message'] = '<strong>No changes were made!</strong>';
    } else {
        if ($check !== false) {

            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            if (in_array($imageFileType, $allowedExtensions)) {
                move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

                $product = new Product();
                $product->updateProduct($target_file, $productId, $productName, $price, $available);

                $_SESSION['update_message'] = '<strong>Sucesss!</strong> Product has been updated!';
            } else {
                $_SESSION['error_message'] = 'Sorry only JPG, JPEG, and PNG files are allowed!';
            }
        } else {
            $_SESSION['error_message'] = 'File is not an image!';
        }
    }
    header('Location: ../views/products.php');
    exit();
}
