<?php
if (!isset($_SESSION['username'])) {
    header('Location: ./login.php');
    exit();
}
?>
<a href="dashboard.php">Dashboard</a>
<a href="menu.php">Menu</a>
<a href="sales.php">Sales</a>
<a href="add-account.php">Add Accounts</a>
<!-- <a href="add-product.php">Add product</a> -->
<a href="products.php">Product Lists</a>

<a href="logout.php">Logout</a>