<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input
    $username_or_email = $conn->real_escape_string(trim($_POST['username_or_email']));
    $password = trim($_POST['password']);

    // Check if the input is a valid email or username
    $query = "SELECT * FROM sellers WHERE email='$username_or_email' OR username='$username_or_email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['seller_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            
            header("Location: index.php"); // Redirect to the homepage after successful login
            exit;
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "No user found with this username or email.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - SokoLima</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="logo-container" style="text-align: center; margin: 20px 0;">
        <img src="sokolima_logo.svg" alt="SokoLima Logo" style="width: 220px;">
    </div>
    <h1>Login to SokoLima</h1>
    <?php if (!empty($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="username_or_email" required placeholder="Username or Email"><br>
        <input type="password" name="password" required placeholder="Password"><br>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a></p>
</body>
</html>
