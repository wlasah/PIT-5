<?php
require_once "database.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
if ($_SESSION["user_id"] != $id) {
    die("Unauthorized access!");
}

$stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
$stmt->bindParam(":id", $id);

if ($stmt->execute()) {
    session_destroy();
    echo "Account deleted. <a href='register.php'>Register Again</a>";
} else {
    echo "Error deleting account.";
}
?>
