<!-- NOT USED AS OF NOW - transitioning to edit modal for better ui experience ;) -->

<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ./login.php');
    exit();
}

require_once '../classes/Product.php';

include '../actions/product-action.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
                    <h1 class="h3 mb-4 text-gray-800">Edit Product</h1>
                    <form method="post" action="../actions/product-action.php">
                        <div class="form-group">
                            <input type="hidden" name="productId" value="<?php echo $currentProduct['id']; ?>" class="form-control form-control-user">
                        </div>
                        <div class="form-group">
                            <input type="text" name="productName" value="<?php echo $currentProduct['product_name']; ?>" class="form-control form-control-user" placeholder="Enter Product Name ..." required>
                        </div>
                        <div class="form-group">
                            <input type="number" name="price" step="0.01" value="<?php echo $currentProduct['price']; ?>" class="form-control form-control-user" placeholder="Enter Price ..." required>
                        </div>
                        <div class="form-group">
                            <input type="number" name="available" value="<?php echo $currentProduct['available']; ?>" class="form-control form-control-user" placeholder="Enter Availability ..." required>
                        </div>
                        <button class="btn btn-warning" type="submit" name="update">Update Product</button>
                    </form>

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