<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registration Page</title>
</head>
<body>

<div class="container">
    <form action="register_process.php" method="post">
        <h2>Register</h2>
        <label for="username">Username:</label>
        <input type="username" id="username" name="username" required>

        <label for="display_name">Display Name:</label>
        <input type="username" id="display_name" name="display_name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="born">Born:</label>
        <input type="date" id="born" name="born" required>

        <label for="gender">Gender:</label>
        <input type="text" id="gender" name="gender" required>

        <label for="image">Profile Photo:</label>
        <input type="file" id="image" name="image" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login here</a>.</p>
</div>

</body>
</html>
