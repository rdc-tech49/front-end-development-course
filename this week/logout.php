<?php

session_start();

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