<?php
if (!isset($_SESSION['username'])) {
    header('Location: ./login.php');
    exit();
}
    if($_SESSION['isadmin'] === 1){
?>
        <a href="dashboard.php">Dashboard</a>
        <a href="add-account.php">Add Accounts</a>
        <a href="add-product.php">Add product</a>
<?php
    }else{?>
        <a href="menu.php">Menu</a>
    <?php
    }
?>
<a href="logout.php">Logout</a>