<head>
<link rel="stylesheet" href="style.css">
</head>


<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize inputs to prevent XSS & SQL Injection
    $first_name = $conn->real_escape_string(trim($_POST['first_name']));
    $last_name = $conn->real_escape_string(trim($_POST['last_name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $username = $conn->real_escape_string(trim($_POST['username']));
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    // Check if email or username already exists
    $check = $conn->query("SELECT * FROM sellers WHERE email='$email' OR username='$username'");
    if ($check->num_rows > 0) {
        echo "Email or username already taken.";
    } else {
        $conn->query("INSERT INTO sellers (first_name, last_name, email, username, password)
                      VALUES ('$first_name', '$last_name', '$email', '$username', '$password')");
        header("Location: login.php");
    }
}
?>

<div class="logo-container" style="text-align: center; margin: 20px 0;">
        <img src="sokolima_logo.svg" alt="SokoLima Logo" style="width: 220px;">
    </div>
<form method="POST">
    <h2>Register a Merchant</h2>
    <input type="text" name="first_name" required placeholder="First Name"><br>
    <input type="text" name="last_name" required placeholder="Last Name"><br>
    <input type="email" name="email" required placeholder="Email"><br>
    <input type="text" name="username" required placeholder="Username"><br>
    <input type="password" name="password" required placeholder="Password"><br>
    <button type="submit">Register</button>
</form>
