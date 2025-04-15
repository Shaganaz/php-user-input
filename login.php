<?php
session_start();
require_once 'User.php';
$user = new User();

if (!$user->usersExist()) {
    header("Location: register.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($user->login($email, $password)) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid credentials');</script>";
    }
}
?>
<html><head><title>Login</title></head><body>
<h2>Login</h2>
<form method="POST">
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>
<p><a href="forgot_password.php">Forgot Password?</a></p>
</body></html>
