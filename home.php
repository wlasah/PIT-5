<?php
require_once "database.php";
session_start();

// Check if the user is logged in, if not redirect to login
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Fetch users from the database
$stmt = $pdo->query("SELECT id, username, email, registration_date FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?= htmlspecialchars($_SESSION["username"]) ?>!</h2>

        <h3>Registered Users</h3>

        <?php if (!empty($users)): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Registration Date</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['registration_date']) ?></td>
                    <td>
                        <a href="update.php?id=<?= $user['id'] ?>">Edit</a> | 
                        <a href="delete.php?id=<?= $user['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php else: ?>
            <p>No users found.</p>
        <?php endif; ?>

        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
