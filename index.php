<?php
session_start();

if (isset($_SESSION["user_id"])) {
    header("Location: home.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to phpACT</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h2>Welcome to phpACT</h2>
    <p>Please choose an option:</p>
    <a href="login.php">Login</a> | <a href="register.php">Register</a>
</body>
</html>
