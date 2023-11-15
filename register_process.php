<?php
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
    $display_name = $_POST["display_name"];
    $email = $_POST["email"];
    $born = $_POST["born"];
    $gender = $_POST["gender"];
    $image = $_POST["image"];
    $password = $_POST["password"];

    $sql = "INSERT INTO $table (username, password, display_name, email, born, gender, image) VALUES ('$username', '$password', '$display_name', '$email', '$born' ,'$gender', '$image')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful";
        header("Location: login.php"); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
