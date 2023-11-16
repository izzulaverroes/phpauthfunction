<?php
session_start();

if (!isset($_SESSION["admin"]) || $_SESSION["admin"] != "1") {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}
// Database connection details
$host = "sql12.freesqldatabase.com";
$dbname = "sql12662040";
$username = "sql12662040";
$password = "eTNIzLyGbE";

// Establish a connection to the database
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Retrieve the user ID from the URL parameter
$user_id = $_GET['id'];

// Query to delete the user by ID (adjust the query according to your database structure)
$deleteQuery = "DELETE FROM USERSDATA WHERE id = :id";
$deleteStmt = $conn->prepare($deleteQuery);
$deleteStmt->bindParam(":id", $user_id);
$deleteStmt->execute();

// Redirect to the admin panel after deleting
header("Location: admin_panel.php");
exit();
?>
