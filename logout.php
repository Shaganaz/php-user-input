<?php
session_start();  
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Logging out...</title>
    <meta http-equiv="refresh" content="2;url=login.php">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <h2>You have been logged out.</h2>
    <p>Redirecting to login page...</p>
</body>
</html>
