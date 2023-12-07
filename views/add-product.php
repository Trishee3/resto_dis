<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ./login.php');
    exit();
}
?>

<!DOCTYPE html> 
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <?php include './sidebar.php'; ?>
    <h3>Add Product</h3>
    <form method="post" enctype="multipart/form-data" action="../actions/product-action.php">
        <label for="productName">Product Name:</label>
        <input type="text" name="productName" required><br>
        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" required><br>
        <label for="qty">Available:</label>
        <input type="number" name="available" required><br>
        <button type="submit" name="add">Add Product</button>
    </form>
</body>

</html>