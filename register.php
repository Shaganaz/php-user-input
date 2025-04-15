<?php
require_once 'User.php';
$user = new User();

if (!$user->usersExist()) {
    header("Location: register.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = new User();
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user->register($username, $email, $password)) {
        echo "<script>alert('Registration successful'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Registration failed');</script>";
    }
}
?>
<html><head><title>Register</title></head><body>
<h2>Register</h2>
<form method="POST">
    Username: <input type="text" name="username" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Register</button>
</form>
<p>Already registered? <a href="login.php">Login here</a></p>
</body></html>
