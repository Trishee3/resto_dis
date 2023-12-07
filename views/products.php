<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ./login.php');
    exit();
}

require_once '../classes/Product.php';

$product = new Product();
$products = $product->getAllProducts();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        img {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>
<body>
    <h1>Product List</h1>
    <?php include './sidebar.php'; ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Available</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($products as $product) : ?>
            <tr>
                <td><?php echo $product['id']; ?></td>
                <td><?php echo $product['product_name']; ?></td>
                <td>₱ <?php echo number_format( $product['price'], 2, '.', ','); ?></td>
                <td><?php echo $product['available']; ?></td>
                <td>
                    <a href="edit-product.php?id=<?php echo $product['id']; ?>">Edit</a>
                    <a href="delete-product.php?id=<?php echo $product['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="add-product.php">Add product</a>
</body>
</html>
