<?php
session_start();
include 'database_config.php';
// include 'functions.php';

 // Include your database connection file


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $password = $_POST['password'];



    // Create a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    
    if ($result->num_rows > 0) {

      
      $user = $result->fetch_assoc();
   
      // Compare the plain text passwords directly
      if (password_verify($password, $user['password'])) {
          // Password is correct, set session variables and redirect to user_dashboard.php
          $_SESSION['id'] = $user['id'];
          $_SESSION['user_name'] = $user['name'];
          $_SESSION['email'] = $user['email'];
          $_SESSION['role'] = $user['role'];


         



           

          // Check user role and redirect accordingly
            if ($user['role'] === 'admin') {
              
                header("Location: admin-page.php");
            } else {
                header("Location: user_dashboard.php");
            }
            exit();
            
      } else {
         // Failed login attempt

          header("Location: index.php?error=Invalid email or password");
          

          exit();
      }
    } else {
      // User not found, redirect back to login with error message
      header("Location: index.php?error=Invalid email or password");
      exit();
    }
  } else {
  echo "Invalid request method.";
  }
?>