<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ./login.php');
    exit();
}

require_once '../classes/Product.php';

$sale = new Product();
$sales = $sale->getAllSales();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales</title>
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
    <h1>Sales</h1>
    <?php include 'sidebar.php'; ?>
    <table>
        <tr>
            <th>Id</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Total Cost</th>
            <th>Date of Transaction</th>
        </tr>
        <?php foreach ($sales as $sale) : ?>
            <tr>
                <td><?php echo $sale['id']; ?></td>
                <td><?php echo $sale['product_name']; ?></td>
                <td><?php echo $sale['quantity']; ?></td>
                <td>₱ <?php echo number_format( $sale['total_cost'], 2, '.', ','); ?></td>
                <td><?php 
                    $date = date_create($sale['transaction_Date']);
                    echo date_format($date, "M d, Y h:i:A");
                ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>