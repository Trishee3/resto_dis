<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ./login.php');
    exit();
}

if ($_SESSION['isadmin'] !== 0) {
    header('Location: 403.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
</head>

<body>
    <h1>Menu</h1>
    <?php include 'sidebar.php'; ?>
</body>

</html>