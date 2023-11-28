<?php
require_once '../classes/Product.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productName = $_POST['productName'];
    $price = $_POST['price'];
    $qty = $_POST['available'];

    $product = new Product();
    $product->addProduct($productName, $price, $qty);

    header('Location: ./dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>

</head>
<body>
    <?php include './sidebar.php'; ?>
    <h3>Add Product</h3>
    <form method="post" enctype="multipart/form-data">
        <label for="productName">Product Name:</label>
        <input type="text" name="productName" required><br>
        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" required><br>
        <label for="qty">Available:</label>
        <input type="number" name="qty" required><br>
        <button type="submit">Add Product</button>
    </form>
</body>
</html>
