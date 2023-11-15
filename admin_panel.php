<?php
session_start();

// var_dump($_SESSION);

// // Check if the user is logged in as an admin
// if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
//     // Redirect to the login page if not logged in
//     header("Location: login.php");
//     exit();
// }

// Database connection details
$host = "sql12.freesqldatabase.com";
$dbname = "sql12662040";
$username = "sql12662040";
$password = "eTNIzLyGbE";

// Establish a connection to the database
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Query to get all users (adjust the query according to your database structure)
$query = "SELECT * FROM USERSDATA";
$stmt = $conn->query($query);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="admin-panel">
            <h1>Welcome, Admin!</h1>
    
            <!-- Display user data in a table -->
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= isset($user['username']) ? $user['username'] : 'N/A'; ?></td>
                            <td><?= isset($user['email']) ? $user['email'] : 'N/A'; ?></td>
                            <td>
                                <a href="edit_user.php?id=<?= $user['id']; ?>">Edit</a>
                                <a href="delete_user.php?id=<?= $user['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
