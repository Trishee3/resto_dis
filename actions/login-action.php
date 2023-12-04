<?php
session_start();

require_once '../classes/Auth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $auth = new Auth();
    if ($auth->login($username, $password)) {
        $_SESSION['username'] = $username;
            header('Location: ../views/dashboard.php');
        exit();
    } else {
        $_SESSION['error'] = "Invalid username or password";
        header('Location: ../views/login.php');
        exit();
    }
}
