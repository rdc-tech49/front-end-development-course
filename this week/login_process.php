<?php
session_start();
include 'database_config.php';
include 'functions.php';

 // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    // $rememberMe = isset($_POST['remember']); // Check if checkbox is checked
    
    // // Validate input (prevent SQL Injection)
    // $email = $conn->real_escape_string($email);
    // $password = $conn->real_escape_string($password);

    // Create a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM customer_info WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
     
      $user = $result->fetch_assoc();
   
      // Compare the plain text passwords directly
      if (password_verify($password, $user['password'])) {
          // Password is correct, set session variables and redirect to user_dashboard.php
          $_SESSION['user_id'] = $user['user_id'];
          $_SESSION['user_name'] = $user['name'];
          $_SESSION['email'] = $user['email'];
           
          // ✅ Handle "Remember Me" feature
           if (isset($_POST["remember"])) {
            $token = bin2hex(random_bytes(32)); // Generate secure token
            setcookie("remember_me", $token, time() + (86400 * 30), "/", "", true, true); // Secure cookie

            // Store token in the database
            $stmt = $conn->prepare("UPDATE customer_info SET remember_token = ? WHERE user_id = ?");
            $stmt->bind_param("si", $token, $user['user_id']);
            $stmt->execute();
            }

          LoginMailSend($email,$user['name']);
          header("Location: user_dashboard.php");
          exit();
      } else {
          // Password is incorrect, redirect back to login with error message
          header("Location: login.php?error=Invalid email or password");
          exit();
      }
    } else {
      // User not found, redirect back to login with error message
      header("Location: login.php?error=Invalid email or password");
      exit();
    }
  } else {
  echo "Invalid request method.";
  }
?>