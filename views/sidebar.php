<?php
if (!isset($_SESSION['username'])) {
    header('Location: ./login.php');
    exit();
}
?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-solid fa-utensils"></i>
        </div>
        <div class="sidebar-brand-text mx-3">RESTO_DIS</sup></div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="menu.php">
            <i class="fas fa-fw fa-list"></i>
            <span>Menu</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="sales.php">
            <i class="fas fa-money-bill-alt"></i>
            <span>Sales</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="products.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Product List</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="add-account.php">
            <i class="fas fa-user"></i>
            <span>Add Account</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>