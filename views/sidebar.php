<?php
    require_once '../classes/User.php';
    $admin = 0;
    // $accessLevel = new User();

    // $admin = $accessLevel->getAccessLevel($access);
    // echo $admin;
    if($admin == 1){
        ?>
        <a href="dashboard.php">Dashboard</a>
        <a href="add-account.php">Add Accounts</a>
        <a href="add-product.php">Add product</a>
    <?php
    }else{?>
        <a href="">Menu</a>
    <?php
    }
?>
