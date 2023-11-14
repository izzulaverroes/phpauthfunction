<?php
session_start();

// Check if the user is logged in as an admin
// if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
//     // Redirect to the login page if not logged in
//     header("Location: index.php");
//     exit();
// }

// Database connection details
$host = "sql12.freesqldatabase.com";
$dbname = "sql12662040";
$username = "sql12662040";
$password = "eTNIzLyGbE";

// Establish a connection to the database
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Retrieve the user ID from the URL parameter
$user_id = $_GET['id'];

// Query to get user data by ID (adjust the query according to your database structure)
$query = "SELECT * FROM DB_USERSDATA WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(":id", $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the form is submitted for updating user data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated user data from the form (adjust according to your database structure)
    $newUsername = $_POST['new_username'];
    $newEmail = $_POST['new_email'];

    // Query to update user data (adjust the query according to your database structure)
    $updateQuery = "UPDATE DB_USERSDATA SET username = :username, email = :email WHERE id = :id";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bindParam(":username", $newUsername);
    $updateStmt->bindParam(":email", $newEmail);
    $updateStmt->bindParam(":id", $user_id);
    $updateStmt->execute();

    // Redirect to the admin panel after updating
    header("Location: admin_panel.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="admin-panel">
        <h1>Edit User</h1>

        <!-- Form for editing user data -->
        <form action="" method="post">
            <label for="new_username">New Username:</label>
            <input type="text" id="new_username" name="new_username" value="<?= $user['username']; ?>" required>

            <label for="new_email">New Email:</label>
            <input type="email" id="new_email" name="new_email" value="<?= $user['email']; ?>" required>

            <button type="submit">Update User</button>
        </form>
    </div>
</body>
</html>
