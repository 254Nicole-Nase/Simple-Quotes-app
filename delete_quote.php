<?php
session_start();
$conn = new mysqli("localhost", "root", "root", "quote_app");

if (isset($_GET['id']) && isset($_SESSION['user_id'])) {
    $quote_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("DELETE FROM quotes WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $quote_id, $user_id);
    $stmt->execute();
}

header("Location: dashboard.php");
?>
