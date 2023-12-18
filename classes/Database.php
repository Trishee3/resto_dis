<?php
class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = 'root';
    private $database = 'php-oop';

    public function connect() {
        $conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}
?>