<?php

session_start();

// Unset the specific session variable
unset($_SESSION['user_name']);

 // Destroy the session
 session_destroy();

// Redirect to the login page or homepage
header("Location: login.php");
exit();




?>