<?php

session_start();
include 'database_config.php';


// Unset the specific session variable
unset( $_SESSION['id']);
unset($_SESSION['name']);
unset($_SESSION['email']);
unset($_SESSION['role']);

 // Destroy the session
session_destroy();
// Remove the "Remember Me" cookie
setcookie("remember_me", "", time() - 3600, "/");

// Redirect to the login page or homepage
header("Location: index.php");
exit();




?>