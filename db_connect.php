<?php
class DB {
    public $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "phuser", "PhpUser@123", "user_auth");

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
}
?>

