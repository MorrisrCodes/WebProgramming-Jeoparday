<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Simple validation
    if (empty($username) || empty($password)) {
        echo "Please fill in all fields.";
    } else {
        // Save user info to session
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;

        // Redirect to the start page after signup
        header("Location: Start.html");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>
    <h1>Signup</h1>
    <form method="POST" action="signup.php">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br><br>
        <input type="submit" value="Sign Up">
    </form>
</body>
</html>
