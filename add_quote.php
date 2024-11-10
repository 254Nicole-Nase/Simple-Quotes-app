<?php
session_start();
$conn = new mysqli("localhost", "root", "root", "quote_app");

if (isset($_POST['quote']) && isset($_SESSION['user_id'])) {
    $quote = $_POST['quote'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO quotes (user_id, quote) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $quote);
    $stmt->execute();
}

header("Location: dashboard.php");
?>
