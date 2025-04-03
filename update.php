<?php
require_once "database.php";
session_start();

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Get user ID from URL
if (!isset($_GET["id"])) {
    header("Location: home.php");
    exit;
}

$id = $_GET["id"];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $id]);
$user = $stmt->fetch();

if (!$user) {
    header("Location: home.php");
    exit;
}

// Update user info
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);

    if (!empty($username) && !empty($email)) {
        $updateStmt = $pdo->prepare("UPDATE users SET username = :username, email = :email WHERE id = :id");
        $updateStmt->execute(['username' => $username, 'email' => $email, 'id' => $id]);

        header("Location: home.php");
        exit;
    } else {
        $error_message = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="update.css">
</head>
<body>
    <div class="container">
        <h2>Update User</h2>

        <?php if (!empty($error_message)): ?>
            <div class="alert error"><?= htmlspecialchars($error_message) ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            <input type="submit" value="Update">
        </form>

        <a href="home.php" class="cancel-btn">Cancel</a>
    </div>
</body>
</html>
