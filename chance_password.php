<!-- change_password.php -->
<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the current password and new password from the form
    $currentPassword = $_POST["currentPassword"];
    $newPassword = $_POST["newPassword"];

    // Implement database update logic (replace with your database connection and query)
    $servername = "sql12.freesqldatabase.com";
    $username = "sql12662040";
    $password = "eTNIzLyGbE";
    $dbname = "sql12662040";
    $table = "DB_USERSDATA";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $loggedInUser = $_SESSION["username"];

    // Check if the current password matches the one in the database
    $sqlCheckPassword = "SELECT * FROM $table WHERE username='$loggedInUser' AND password='$currentPassword'";
    $resultCheckPassword = $conn->query($sqlCheckPassword);

    if ($resultCheckPassword->num_rows == 1) {
        // Update the password in the database
        $sqlUpdatePassword = "UPDATE $table SET password='$newPassword' WHERE username='$loggedInUser'";
        $resultUpdatePassword = $conn->query($sqlUpdatePassword);

        if ($resultUpdatePassword) {
            echo "Password updated successfully.";
        } else {
            echo "Error updating password: " . $conn->error;
        }
    } else {
        echo "Current password is incorrect.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Change Password</title>
</head>
<body>

<div class="container">
    <h2>Change Password</h2>

    <form action="change_password.php" method="post">
        <label for="currentPassword">Current Password:</label>
        <input type="password" id="currentPassword" name="currentPassword" required>

        <label for="newPassword">New Password:</label>
        <input type="password" id="newPassword" name="newPassword" required>

        <button type="submit">Change Password</button>
    </form>

    <p><a href="dashboard.php">Back to Dashboard</a></p>
</div>

</body>
</html>
