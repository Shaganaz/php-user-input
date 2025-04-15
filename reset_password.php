<?php
require_once 'User.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $newPassword = $_POST['password'];
        $user = new User();

        if ($user->resetPassword($token, $newPassword)) {
            echo "<script>alert('Password reset successful'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Invalid or expired token');</script>";
        }
    }
}
?>
<html><head><title>Reset Password</title></head><body>
<h2>Reset Your Password</h2>
<form method="POST">
    <input type="password" name="password" placeholder="New Password" required>
    <button type="submit">Reset Password</button>
</form>
</body></html>
