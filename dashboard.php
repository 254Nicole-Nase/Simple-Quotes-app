<?php
session_start();
$conn = new mysqli("localhost", "root", "root", "quote_app");

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch user's saved quotes
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT id, quote FROM quotes WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch daily motivational quote from an API using cURL
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.quotable.io/random",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false, // Disable SSL verification for local testing only
    CURLOPT_SSL_VERIFYHOST => false  // Disable SSL verification for local testing only
]);
$response = curl_exec($curl);

if (curl_errno($curl)) {
    $daily_quote = "Could not fetch quote."; // Error handling if cURL fails
} else {
    $data = json_decode($response, true);
    $daily_quote = $data['content'] ?? "Could not fetch quote."; // Fetch content or set default message
}

curl_close($curl);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to the CSS file -->
</head>
<body>
    <h2>Welcome to Your Quote Dashboard</h2>
    <p>Daily Quote: <?php echo htmlspecialchars($daily_quote); ?></p>

    <!-- Form to add a new quote -->
    <form method="POST" action="add_quote.php">
        <input type="text" name="quote" placeholder="Enter a new quote" required>
        <button type="submit">Add Quote</button>
    </form>

    <!-- Display saved quotes -->
    <h3>Your Saved Quotes</h3>
    <ul>
        <?php while ($row = $result->fetch_assoc()): ?>
            <li>
                <?php echo htmlspecialchars($row['quote']); ?>
                <a href="delete_quote.php?id=<?php echo $row['id']; ?>">Delete</a>
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>

