<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ./login.php');
    exit();
}

require_once '../classes/Product.php';

// Check if the product ID is provided in the URL
if (!isset($_GET['id'])) {
    header('Location: ./menu.php');
    exit();
}

$product = new Product();
$productID = $_GET['id'];
$selectedProduct = $product->getProductById($productID);

// Check if the product with the given ID exists
if (!$selectedProduct) {
    header('Location: ./menu.php');
    exit();
}

// Handle POS transaction on form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have a method like 'processTransaction' in your Product class
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;

    if ($quantity > 0 && $quantity <= $selectedProduct['available']) {
        $totalCost = $quantity * $selectedProduct['price'];

        // Process the transaction (update quantities, record the sale, etc.)
        $product->processTransaction($productID, $quantity, $totalCost);

        // Redirect to a success page or show a success message
        header('Location: ./success.php');
        exit();
    } else {
        $errorMessage = 'Invalid quantity or insufficient stock.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS - <?php echo $selectedProduct['product_name']; ?></title>
    <style>
        /* Add your POS styles here */
    </style>
</head>

<body>
    <h1>Point of Sale - <?php echo $selectedProduct['product_name']; ?></h1>
    <?php include 'sidebar.php'; ?>

    <div>
        <h2>Product Information</h2>
        <p>ID: <?php echo $selectedProduct['id']; ?></p>
        <p>Name: <?php echo $selectedProduct['product_name']; ?></p>
        <p>Price: ₱<?php echo number_format($selectedProduct['price'], 2, '.', ','); ?></p>
        <p>Available: <?php echo $selectedProduct['available']; ?></p>
        <!-- Add additional product details as needed -->
    </div>

    <!-- POS Form -->
    <div>
        <h2>POS Transaction</h2>
        <form method="post">
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" min="1" max="<?php echo $selectedProduct['available']; ?>" required>
            <button type="submit">Submit</button>
        </form>

        <?php if (isset($errorMessage)) : ?>
            <p style="color: red;"><?php echo $errorMessage; ?></p>
        <?php endif; ?>
    </div>

    <!-- Add your POS functionality and interface here -->

</body>

</html>
