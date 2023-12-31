<?php    
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--| Style -->
    <link rel="stylesheet" href="style.css">
    <title id="pagetitle">CyberHazen™ | Profile</title>
</head>

<body>
    <section class="menu" id="menu">
        <div class="container">
        <h2>Welcome back! <?php echo $_SESSION["username"]; ?></h2>
            <!-- Display other user information -->
            <?php
                if (isset($_SESSION["username"])) {
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
                    $sql = "SELECT * FROM $table WHERE username='$loggedInUser'";
                    $result = $conn->query($sql);

                    if ($result->num_rows == 1) {
                        $userData = $result->fetch_assoc();

                        // Check if the keys exist before trying to access them
                        $email = isset($userData["email"]) ? $userData["email"] : "N/A";
                        $displayName = isset($userData["display_name"]) ? $userData["display_name"] : "N/A";
                        $password = isset($userData["password"]) ? $userData["password"] : "N/A";
                        $image = isset($userData["image"]) ? $userData["image"] : "N/A";
                        $gender = isset($userData["gender"]) ? $userData["gender"] : "N/A";
                        $born = isset($userData["born"]) ? $userData["born"] : "N/A";

                        echo "<p>Email: " . $email . "</p>";
                        echo "<p>Display Name: " . $displayName . "</p>";
                        echo "<p>Password: " . $password . "</p>";
                        echo "<p>Your gender: " . $gender . "</p>";
                        echo "<p>You was Born in :  " . $born . "</p>";
                        // echo "<img src=". $image ." />";
                    } else {
                        echo "User not found in the database.";
                    }

                    $conn->close();
                } else {
                    // Redirect to the login page or handle the situation where the user is not authenticated
                    header("Location: login.php");
                    exit();
                }
                ?>
        <a href="logout.php"><button type="button">Log Out</button></a>
        <a href="change_username.php"><button type="button">Change Username</button></a>
        <a href="change_password.php"><button type="button">Change Password</button></a>
        <a href="delete_account.php"><button type="button">Delete Account</button></a>
        <a href="upload_image.php"><button type="button">Upload Image</button></a>
        <a href="admin_panel.php"><button type="button">Admin Panel</button></a>
        </div>
    </section>
</body>
</html>