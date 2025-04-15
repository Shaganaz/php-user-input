<?php
// User.php
require_once 'db_connect.php';

class User {
    private $conn;

    public function __construct() {
        $db = new DB();
        $this->conn = $db->conn;
    }

    public function register($username, $email, $password) {
        $salt = bin2hex(random_bytes(32));
        $hashed_password = hash('sha256', $password . $salt);

        $stmt = $this->conn->prepare("INSERT INTO users (username, email, password, salt) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $salt);

        return $stmt->execute();
    }

    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT id, username, password, salt FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $username, $hashed_password, $salt);
            $stmt->fetch();
            if (hash('sha256', $password . $salt) === $hashed_password) {
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                return true;
            }
        }
        return false;
    }

    public function requestPasswordReset($email) {
        $token = bin2hex(random_bytes(50));
        $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

        $stmt = $this->conn->prepare("UPDATE users SET reset_token = ?, reset_expires = ? WHERE email = ?");
        $stmt->bind_param("sss", $token, $expires, $email);

        if ($stmt->execute()) {
            file_put_contents("reset_link.txt", "http://localhost/reset_password.php?token=$token");
            return true;
        }
        return false;
    }

    public function resetPassword($token, $newPassword) {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE reset_token = ? AND reset_expires > NOW()");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id);
            $stmt->fetch();
            $salt = bin2hex(random_bytes(32));
            $hashed_password = hash('sha256', $newPassword . $salt);

            $stmt = $this->conn->prepare("UPDATE users SET password = ?, salt = ?, reset_token = NULL, reset_expires = NULL WHERE id = ?");
            $stmt->bind_param("ssi", $hashed_password, $salt, $id);
            return $stmt->execute();
        }
        return false;
    }
    public function usersExist() {
    $sql = "SELECT COUNT(*) FROM users";
    $result = $this->conn->query($sql);
    $row = $result->fetch_row();
    return $row[0] > 0;
}

}
?>
