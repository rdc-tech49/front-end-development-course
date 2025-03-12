<?php

session_start();
include 'database_config.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Update the last login record with logout time
    $stmt = $conn->prepare("UPDATE audit_logs SET logout_time = NOW() WHERE user_id = ? AND action_type = 'login' ORDER BY timestamp DESC LIMIT 1");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
}
// Unset the specific session variable
unset( $_SESSION['user_id']);
unset($_SESSION['user_name']);
unset($_SESSION['email']);
 // Destroy the session
session_destroy();
// Remove the "Remember Me" cookie
setcookie("remember_me", "", time() - 3600, "/");

// Redirect to the login page or homepage
header("Location: login.php");
exit();




?>