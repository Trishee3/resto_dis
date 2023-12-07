<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ./login.php');
    exit();
}

require_once '../classes/Product.php';

if (!isset($_GET['id'])) {
    header('Location: ./menu.php');
    exit();
}

$product = new Product();
$productID = $_GET['id'];
$selectedProduct = $product->getProductById($productID);

if (!$selectedProduct) {
    header('Location: ./menu.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS - <?php echo $selectedProduct['product_name']; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
    </div>

    <div>
        <h2>POS Transaction</h2>
        <form method="post" action="../actions/pay-action.php?id=<?php echo $productID; ?>">
            <input type="hidden" name="productName" value="<?php echo $selectedProduct['product_name']; ?>">
            <label for="quantity">Number of Plates:</label>
            <input type="number" name="quantity" id="quantityInput" min="1" max="<?php echo $selectedProduct['available']; ?>" required> <br />
            <label for="discount">Discount</label>
            <select name="discount" id="selectDiscount">
                <option value="none">None</option>
                <option value="sc">Senior Citizen</option>
                <option value="pwd">PWD</option>
            </select>

            <!-- input how many customers is discounted -->
            <input type="number" name="numOfDisc" id="numOfDiscounts" min="1">

            <h3>Transaction Summary</h3>
            <p>Subtotal: ₱ <span id="subtotal">0.00</span></p>
            <p>Discount: <span id="discount">0.00</span> %</p>
            <p>Total: ₱ <span id="total">0.00</span></p>
            <button type="submit" name="pay">Submit</button>
        </form>

        <?php if (isset($errorMessage)) : ?>
            <p style="color: red;"><?php echo $errorMessage; ?></p>
        <?php endif; ?>
    </div>

    <script>
        document.getElementById('quantityInput').addEventListener('input', function () {
            updateTransactionSummary();
        });

        document.getElementById('selectDiscount').addEventListener('change', function () {
            updateTransactionSummary();
        });

        document.getElementById('numOfDiscounts').addEventListener('input', function () {
            updateTransactionSummary();
        });

        function updateTransactionSummary() {
            var quantity = parseInt(document.getElementById('quantityInput').value);
            var price = <?php echo $selectedProduct['price']; ?>;
            var discountType = document.getElementById('selectDiscount').value;
            var numOfDiscount = parseInt(document.getElementById('numOfDiscounts').value);
            
            var subtotal = quantity * price;
            document.getElementById('subtotal').innerText = subtotal.toFixed(2);

            var discount = 0;

            if(discountType === 'pwd'){
                discount = .20;
            }else if(discountType === 'sc'){
                discount = .20;
            }

            if(numOfDiscount > 0){
                discount *= numOfDiscount;
            }

            document.getElementById('discount').innerText = (discount * 100).toFixed(2);

            var total = subtotal - (subtotal * discount);
            document.getElementById('total').innerText = total.toFixed(2);
        }
    </script>

</body>

</html>
