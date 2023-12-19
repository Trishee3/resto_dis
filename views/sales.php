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

                    <h1 class="h3 mb-4 text-gray-800">Sales</h1>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Discount</th>
                                            <th>Total Cost</th>
                                            <th>Date of Transaction</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Discount</th>
                                            <th>Total Cost</th>
                                            <th>Date of Transaction</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($sales as $sale) : ?>
                                            <tr>
                                                <td><?php echo $sale['id']; ?></td>
                                                <td><?php echo $sale['product_name']; ?></td>
                                                <td><?php echo $sale['quantity']; ?></td>
                                                <td>₱ <?php echo $sale['discount']; ?></td>
                                                <td>₱ <?php echo number_format($sale['total_cost'], 2, '.', ','); ?></td>
                                                <td>
                                                    <?php
                                                    $date = date_create($sale['transaction_Date']);
                                                    echo date_format($date, "M d, Y h:i:A");
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#transactionModal_<?php echo $sale['id']; ?>">View Invoice</a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="transactionModal_<?php echo $sale['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <span>Transaction Id No.</span><br/>
                                                                    <strong><?php echo $sale['id']; ?></strong>
                                                                </div>
                                                                <div class="col-sm-6 text-right">
                                                                    <span>Payment Date</span><br/>
                                                                    <strong><?php echo date_format($date, "M d, Y h:i:A"); ?></strong>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <span>Customer</span><br/>
                                                                    <strong>
                                                                        <?php echo $sale['customer_name'] !== '' ? $sale['customer_name'] : "N/A"; ?>
                                                                    </strong>
                                                                </div>
                                                                <div class="col-sm-6 text-right">
                                                                    <span>From</span><br/>
                                                                    <strong>
                                                                        Resto Dis
                                                                    </strong>
                                                                    <!-- <p>
                                                                        Molugan, EL Salvador City<br>
                                                                        Misamis Oriental <br>
                                                                        9017 <br>
                                                                        Philippines <br>
                                                                        <a href="#">
                                                                            redto_dis@gmail.com
                                                                        </a>
                                                                    </p> -->
                                                                </div>
                                                            </div>
                                                            <br />
                                                            <div class="row">
                                                                <div class="col">Product</div>
                                                                <div class="col">Quantity</div>
                                                                <div class="col">Discount Type</div>
                                                                <div class="col">Discounted Persons</div>
                                                                <div class="col">Amount</div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <?php echo $sale['product_name']?>
                                                                </div>
                                                                <div class="col">
                                                                    <?php echo $sale['quantity']?>
                                                                </div>
                                                                <div class="col">
                                                                    <?php echo $sale['discount_type']; ?>
                                                                </div>
                                                                <div class="col">
                                                                    <?php if($sale['num_of_discounted'] > 0) : ?>
                                                                        <?php echo $sale['num_of_discounted']; ?>
                                                                    <?php endif; ?>
                                                                    <?php if($sale['num_of_discounted'] <= 0) : ?>
                                                                        <?php echo 'None' ; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="col">
                                                                    ₱ <?php echo number_format($sale['total_cost'] +  $sale['discount'], 2, '.', ',')?>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-12 col-sm-6 col-md-8"></div>
                                                                <div class="col-6 col-md-4">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            Subtotal
                                                                        </div>
                                                                        <div class="col">
                                                                            ₱ <?php echo number_format($sale['total_cost'] +  $sale['discount'], 2, '.', ',')?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12 col-sm-6 col-md-8"></div>
                                                                <div class="col-6 col-md-4">
                                                                    <div class="row">
                                                                    <div class="col">
                                                                            Discount
                                                                        </div>
                                                                        <div class="col">
                                                                            ₱ <?php echo number_format($sale['discount'], 2, '.', ',');?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12 col-sm-6 col-md-8"></div>
                                                                <div class="col-6 col-md-4">
                                                                    <div class="row">
                                                                    <div class="col">
                                                                            <strong>TOTAL</strong>
                                                                        </div>
                                                                        <div class="col">
                                                                            ₱ <?php echo number_format($sale['total_cost'], 2, '.', ','); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
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
                </div>
            </div>
        </div>
    </div>


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
</body>

</html>