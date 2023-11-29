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
    $currentProduct = $product->getProductById($productId);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $productId = $_POST['productId'];
    $productName = $_POST['productName'];
    $price = $_POST['price'];
    $qty = $_POST['available'];

    $product = new Product();
    $product->updateProduct($productId, $productName, $price, $qty);

    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <?php include './sidebar.php'; ?>
    <h3>Edit Product</h3>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="productId" value="<?php echo $currentProduct['id']; ?>">
        <label for="productName">Product Name:</label>
        <input type="text" name="productName" value="<?php echo $currentProduct['product_name']; ?>" required><br>
        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" value="<?php echo $currentProduct['price']; ?>" required><br>
        <label for="qty">Available:</label>
        <input type="number" name="qty" value="<?php echo $currentProduct['available']; ?>" required><br>
        <button type="submit" name="update">Update Product</button>
    </form>
</body>
</html>
