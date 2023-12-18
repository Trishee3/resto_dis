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
    <title>Pay</title>
    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    </style>
</head>

<body id="page-top">

    <div id="wrapper">
        <?php include 'sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'topbar.php'; ?>
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Pay</h1>

                    <div class="row text-gray-800">
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Order Details</h6>
                                </div>
                                <div class="card-body">
                                    <p>ID: <?php echo $selectedProduct['id']; ?></p>
                                    <p>Product Name: <?php echo $selectedProduct['product_name']; ?></p>
                                    <p>Price: ₱<?php echo number_format($selectedProduct['price'], 2, '.', ','); ?></p>
                                    <p>Available: <?php echo $selectedProduct['available']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Purchase Details</h6>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="../actions/pay-action.php?id=<?php echo $productID; ?>" class="user">
                                        <input type="hidden" name="productName" value="<?php echo $selectedProduct['product_name']; ?>">
                                        <label for="customer"><strong>Customer's Name:</strong></label>
                                        <input type="text" name="customer" class="col-sm-3 my-1 form-control" required> <br />
                                        <label for="quantity"><strong>Number of Plates:</strong></label>
                                        <input type="number" name="quantity" class="col-sm-3 my-1 form-control" id="quantityInput" min="1" max="<?php echo $selectedProduct['available']; ?>" required> <br />
                                        <label for="discount"><strong>Discount:</strong></label>
                                        <div class="form-inline">
                                            <div class="form-group mb-2">
                                                <select name="discount" id="selectDiscount" class="form-select form-select-lg">
                                                    <option value="none">None</option>
                                                    <option value="sc">Senior Citizen</option>
                                                    <option value="pwd">PWD</option>
                                                    <option value="5blw">5 below</option>
                                                </select>
                                            </div>
                                            <div class="form-group mx-sm-3 mb-2">
                                                <!-- input how many customers is discounted -->
                                                <input type="number" name="numOfDisc" id="numOfDiscounts" min="1" class="col-sm-4 form-control">
                                            </div>
                                        </div>
                                        <hr>
                                        <h3>Transaction Summary</h3>
                                        <!-- <p>Subtotal: ₱ <span id="subtotal">0.00</span></p>
                                        <p>Discount: <span id="discount">0.00</span> %</p>
                                        <p>Total: ₱ <span id="total">0.00</span></p> -->
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-md-8">
                                                <div class="row">
                                                    <div class="col">
                                                        Subtotal
                                                    </div>
                                                    <div class="col">
                                                        <span id="subtotal">0.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-md-8">
                                                <div class="row">
                                                    <div class="col">
                                                        Discount
                                                    </div>
                                                    <div class="col">
                                                        <span id="discount">0.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-md-8">
                                                <div class="row">
                                                    <div class="col">
                                                        <strong>TOTAL</strong>
                                                    </div>
                                                    <div class="col">
                                                        <span id="total">0.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                            </div>
                                        </div>
                                        <br />
                                        <hr>
                                        <button type="submit" class="btn btn-sm btn-success" name="pay">Purchase</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <script>
                document.getElementById('quantityInput').addEventListener('input', function() {
                    updateTransactionSummary();
                });

                document.getElementById('selectDiscount').addEventListener('change', function() {
                    updateTransactionSummary();
                });

                document.getElementById('numOfDiscounts').addEventListener('input', function() {
                    updateTransactionSummary();
                });

                function updateTransactionSummary() {
                    const formatter = new Intl.NumberFormat('en-PH', {
                        style: 'currency',
                        currency: 'PHP',
                    });

                    var quantity = parseInt(document.getElementById('quantityInput').value);
                    quantity = isNaN(quantity) ? 0 : quantity;
                    var price = <?php echo $selectedProduct['price']; ?>;
                    var discountType = document.getElementById('selectDiscount').value;
                    var numOfDiscount = parseInt(document.getElementById('numOfDiscounts').value);
                    var subtotal = quantity * price;
                    document.getElementById('subtotal').innerText = formatter.format(subtotal);

                    var discount = 0;

                    if (discountType === 'pwd') {
                        discount = .20;
                    } else if (discountType === 'sc') {
                        discount = .20;
                    } else if (discountType === '5blw') {
                        discount = .20;
                    }

                    //calculate the discount first
                    var discountedPrice = price * discount;

                    if(discount > 0 && isNaN(numOfDiscount)){
                        numOfDiscount = 1;
                    }

                    //then calculate how many person is discounted
                    var finalDiscount = discountedPrice * numOfDiscount;

                    if(discountType === 'none'){
                        finalDiscount = 0;
                    }


                    document.getElementById('discount').innerText = formatter.format(finalDiscount);

                    var total = subtotal - finalDiscount;
                    document.getElementById('total').innerText = formatter.format(total);
                }
            </script>

            <?php include 'logoutmodal.php'; ?>
            <!-- Bootstrap core JavaScript-->
            <script src="../assets/vendor/jquery/jquery.min.js"></script>
            <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="../assets/js/sb-admin-2.min.js"></script>
</body>

</html>