<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Implement account deletion logic here

// Example using a database connection
$servername = "sql12.freesqldatabase.com";
$username = "sql12662040";
$password = "eTNIzLyGbE";
$dbname = "sql12662040";
$table = "USERSDATA";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$loggedInUser = $_SESSION["username"];

// Delete the user account from the database
$sql = "DELETE FROM $table WHERE username='$loggedInUser'";
$result = $conn->query($sql);

if ($result) {
    // Account deleted successfully
    header("Location: logout.php"); // Redirect to logout page after deletion
    exit();
} else {
    echo "Error deleting account: " . $conn->error;
}

$conn->close();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Delete Account</title>
</head>
<body>

<div class="container">
    <h2>Delete Account</h2>

    <p>Are you sure you want to delete your account? This action cannot be undone.</p>

    <form action="delete_account.php" method="post">
        <!-- Add any additional confirmation fields here, e.g., password -->
        <button type="submit">Delete Account</button>
    </form>

    <p><a href="dashboard.php">Back to Dashboard</a></p>
</div>

</body>
</html>
