<?php
session_start();
require_once '../classes/Auth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $auth = new Auth();
    if ($auth->login($username, $password)) {
        
        $_SESSION['username'] = $username;

        if($_SESSION['isadmin'] === 1){
            header('Location: dashboard.php');
        }else if($_SESSION['isadmin'] === 0){
            header('Location: menu.php');
        }else{
            header('Location: 403.php');
        }
        exit();
    } else {
        $error = "Invalid username or password";
    }
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
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
    <br />
</body>
</html>