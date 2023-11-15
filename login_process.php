<?php
session_start();

$servername = "sql12.freesqldatabase.com";
$username = "sql12662040";
$password = "eTNIzLyGbE";
$dbname = "sql12662040";
$table = "USERSDATA";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM $table WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION["username"] = $username;
        header("Location: dashboard.php"); // Redirect to a dashboard page or home page after successful login
    } else {
        echo "<script>alert('Invalid username or password')</script>";
        header("Location: login.php");
    }
}

$conn->close();
?>
