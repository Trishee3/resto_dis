<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ./login.php');
    exit();
}

require_once '../classes/Product.php';

$product = new Product();
$products = $product->getAllProducts();

$errorMessage = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : null;
unset($_SESSION['error_message']);

$successMessage = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : null;
unset($_SESSION['success_message']);

$updateMessage = isset($_SESSION['update_message']) ? $_SESSION['update_message'] : null;
unset($_SESSION['update_message']);

$deleteMessage = isset($_SESSION['delete_message']) ? $_SESSION['delete_message'] : null;
unset($_SESSION['delete_message']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Products</title>
    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    </style>
</head>

<body id="page-top">

    <div id="wrapper">
        <?php include 'sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'topbar.php'; ?>
                <div class="container-fluid">
                    <!-- alert messages -->
                    <?php if ($errorMessage) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $errorMessage; ?>
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </div>
                    <?php endif; ?>
                    <?php if ($successMessage) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Sucesss!</strong> <?php echo $successMessage; ?>
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </div>
                    <?php endif; ?>
                    <?php if ($updateMessage) : ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?php echo $updateMessage; ?>
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </div>
                    <?php endif; ?>
                    <?php if ($deleteMessage) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?php echo $deleteMessage; ?></strong>
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </div>
                    <?php endif; ?>
                    <h1 class="h3 mb-4 text-gray-800">Product List</h1>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Available</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Available</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($products as $product) : ?>
                                            <tr>
                                                <td><?php echo $product['id']; ?></td>
                                                <td><img src="<?php echo $product['image']; ?>" style="width: 100px; height: 100px;" class="rounded" alt="Product Image"></td>
                                                <td><?php echo $product['product_name']; ?></td>
                                                <td>₱ <?php echo number_format($product['price'], 2, '.', ','); ?></td>
                                                <td><?php echo $product['available']; ?></td>
                                                <td>
                                                    <!-- <a href="edit-product.php?id=<?php echo $product['id']; ?>" class="btn btn-sm btn-warning">Update</a> -->
                                                    <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal_<?php echo $product['id']; ?>">Update</a>
                                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal">Delete</button>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="editModal_<?php echo $product['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Product - <?php echo $product['product_name']; ?></h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="../actions/product-action.php" enctype="multipart/form-data">
                                                                <div class="form-group">
                                                                    <input type="hidden" name="productId" value="<?php echo $product['id']; ?>" class="form-control form-control-user">
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-md-4">
                                                                            <img src="<?php echo $product['image']; ?>" alt="Current Product Image" style="max-width: 100%; max-height: 100%;" class="rounded">
                                                                        </div>
                                                                        <div class="col">
                                                                            <input type="file" name="image" class="form-control-file form-control-user" accept="image/*" onchange="displayImage(this);" required>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" name="productName" value="<?php echo $product['product_name']; ?>" class="form-control form-control-user" placeholder="Enter Product Name ..." required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="number" name="price" step="0.01" value="<?php echo $product['price']; ?>" class="form-control form-control-user" placeholder="Enter Price ..." required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="number" name="available" value="<?php echo $product['available']; ?>" class="form-control form-control-user" placeholder="Enter Availability ..." required>
                                                                </div>
                                                                <hr>
                                                                <div class="text-right">
                                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                                                    <button class="btn btn-warning" type="submit" name="update">Update</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <a href="#" data-toggle="modal" data-target="#addProductModal" class="btn btn-sm btn-success">Add Product</a>
                </div>
            </div>
        </div>
    </div>
    <?php include 'existing-product-modal.php'; ?>
    <?php include 'add-product-modal.php'; ?>
    <?php include 'deletemodal.php'; ?>
    <?php include 'logoutmodal.php'; ?>
    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/datatables-demo.js"></script>

    <!-- <script>
        // Assuming you have a condition to check if the product already exists
        var productAlreadyExists = <?php echo $existingProduct; ?>;

        // Check the condition and show the modal if necessary
        if (productAlreadyExists) {
            $(document).ready(function () {
                $("#existingProductModal").modal("show");
            });
        }
    </script> -->
</body>

</html>