<?php
session_start();

$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);

if (isset($_SESSION['username'])) {
    if ($_SESSION['isadmin'] === 1) {
        header('Location: dashboard.php');
    } else if ($_SESSION['isadmin'] === 0) {
        header('Location: menu.php');
    } else {
        header('Location: 403.php');
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>
    <?php if ($error) echo "<p>$error</p>"; ?>
    <form method="post" action="../actions/login-action.php">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
    <br />
</body>

</html>