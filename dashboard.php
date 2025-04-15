<?php
session_start();
require_once 'User.php';

$user = new User();

if (!$user->usersExist()) {
    header("Location: register.php");
    exit();
}


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<html><head><title>Dashboard</title></head><body>
<h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
<p>You are now logged in.</p>
<a href="logout.php">Logout</a>
</body></html>
