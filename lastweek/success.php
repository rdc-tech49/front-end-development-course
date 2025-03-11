<?php
session_start();

// If user is not logged in, check for "Remember Me" cookies
if (!isset($_SESSION['user']) && isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
    $_SESSION['user'] = $_COOKIE['email'];
}

// Logout if "logout=true" is in URL
if (isset($_GET['logout'])) {
    session_destroy(); // Clear session
    header("Location: index.html"); // Redirect to login page
    exit();
}

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
    </style>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['user']; ?>! You have successfully logged in.</h2>
    <a href="success.php?logout=true">Logout</a>
</body>
</html>
