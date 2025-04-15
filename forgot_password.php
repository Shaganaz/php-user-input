<?php
require_once 'User.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $user = new User();

    if ($user->requestPasswordReset($email)) {
        echo "<script>alert('Reset link sent. Check reset_link.txt');</script>";
    } else {
        echo "<script>alert('Failed to send reset link');</script>";
    }
}
?>
<html><head><title>Forgot Password</title></head><body>
<h2>Forgot Password</h2>
<form method="POST">
    <input type="email" name="email" placeholder="Your Email" required>
    <button type="submit">Send Reset Link</button>
</form>
</body></html>
