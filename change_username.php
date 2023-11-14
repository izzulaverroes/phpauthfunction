<!-- change_username.php -->
<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the new username from the form
    $newUsername = $_POST["newUsername"];

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

    // Update the username in the database
    $sql = "UPDATE $table SET username='$newUsername' WHERE username='$loggedInUser'";
    $result = $conn->query($sql);

    if ($result) {
        echo "Username updated successfully.";
        $_SESSION["username"] = $newUsername; // Update the session variable
        header("Location: dashboard.php");
    } else {
        echo "Error updating username: " . $conn->error;
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
    <title>Change Username</title>
</head>
<body>

<div class="container">
    <h2>Change Username</h2>

    <form action="change_username.php" method="post">
        <label for="newUsername">New Username:</label>
        <input type="text" id="newUsername" name="newUsername" required>
        <button type="submit">Change Username</button>
    </form>

    <p><a href="dashboard.php">Back to Dashboard</a></p>
</div>

</body>
</html>
