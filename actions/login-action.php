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

            header('Location: ../views/dashboard.php');

        }else if($_SESSION['isadmin'] === 0){

            header('Location: ../views/menu.php');

        }else{
            header('Location: ../views/403.php');
        }
        exit();
    } else {
        $_SESSION['error'] = "Invalid username or password";
        header('Location: ../views/login.php');
        exit();
    }
}
?>