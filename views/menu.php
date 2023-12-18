<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ./login.php');
    exit();
}

require_once '../classes/Product.php';

$product = new Product();
$products = $product->getAllProducts();

$successMessage = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : null;
unset($_SESSION['success_message']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <div id="wrapper">
        <?php include 'sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'topbar.php'; ?>
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <?php if ($successMessage) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><?php echo $successMessage; ?></strong>
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </div>
                    <?php endif; ?>
                    <h1 class="h3 mb-4 text-gray-800">Menu</h1>
                    <div class="d-flex justify-content-start">
                        <div class="row">
                            <?php foreach ($products as $product) : ?>
                                <div class="col">
                                    <div class="card" style="width: 18rem; margin-bottom: 15px;">
                                        <img src="<?php echo $product['image']?>" class="card-img-top" alt="Product Image" style="width: 100%; height: 200px;">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $product['product_name']; ?></h5>
                                            <p class="card-text">Price: ₱ <?php echo number_format($product['price'], 2, '.', ','); ?></p>
                                            <p class="card-text">Available: <?php echo $product['available']; ?></p>
                                            <?php if($product['available'] <= 0) : ?>
                                                <a href="#" class="btn btn-primary disabled">Purchase</a>
                                            <?php endif; ?>
                                            <?php if($product['available'] > 0) : ?>
                                                <a href="pay.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">Purchase</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>

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