<?php
require_once 'User.php';

class Auth {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function login($username, $password) {
        $user = $this->user->getUserByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            return true;
        }
        return false;
    }
}
?>