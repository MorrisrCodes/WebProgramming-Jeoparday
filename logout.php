<?php
session_start();

// Destroy the session to log the user out
session_destroy();

// Redirect to login page
header("Location: login.html");
exit();
?>
