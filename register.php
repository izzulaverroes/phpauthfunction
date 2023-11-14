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
        <select id="gender" name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>

        <label for="image">Profile Photo:</label>
        <input type="file" id="image" name="image" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" onclick="validateForm()">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login here</a>.</p>
</div>
<script>
        function validateForm() {
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;
            var displayName = document.getElementById('display_name').value;
            var gender = document.getElementById('gender').value;
            var email = document.getElementById('email').value;

            // Validate username length
            if (username.length < 6) {
                alert("Username must be at least 6 characters long");
                return false;
            }

            // Validate password length
            if (password.length < 8) {
                alert("Password must be at least 8 characters long");
                return false;
            }

            // Validate display name for at least one special character
            if (!/[!@#$%^&*(),.?":{}|<>]/.test(displayName)) {
                alert("Display Name must contain at least one special character");
                return false;
            }

            // Validate display name for at least one special character
            if (!/[@]/.test(email)) {
                alert("Incorrect email format");
                return false;
            }

            // Validate gender (only "male" or "female" allowed)
            if (!(gender === "male" || gender === "female")) {
                alert("Invalid gender");
                return false;
            }

            // If all validations pass, you can submit the form
            alert("Form submitted successfully!");
            return true;
        }
    </script>
</body>
</html>
