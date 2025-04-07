<?php
session_start();

// If the user is already logged in, redirect to the start page
if (isset($_SESSION['username'])) {
    header("Location: game.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Simple validation
    if (empty($username) || empty($password)) {
        echo "Please fill in both username and password.";
    } else {
        // Check if the entered credentials match the session data
        if ($username === $_SESSION['username'] && $password === $_SESSION['password']) {
            // User is logged in, redirect to the game page
            header("Location: game.php");
            exit();
        } else {
            echo "Invalid username or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST" action="login.php">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
