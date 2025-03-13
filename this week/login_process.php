<?php
session_start();
include 'database_config.php';
include 'functions.php';

 // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
// Get user's location
$latitude = isset($_POST['latitude']) ? $_POST['latitude'] : null;
$longitude = isset($_POST['longitude']) ? $_POST['longitude'] : null;




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
          $_SESSION['role'] = $user['role'];


          //login logs query 
          // Capture IP & User Agent
          $ip_address = $_SERVER['REMOTE_ADDR'];
          $user_agent = $_SERVER['HTTP_USER_AGENT'];
          // Insert login log
          $logQuery = "INSERT INTO login_logs (user_id, ip_address, user_agent) VALUES (?, ?, ?)";
          $logStmt = $conn->prepare($logQuery);
          $logStmt->bind_param("iss", $user['user_id'], $ip_address, $user_agent);
          $logStmt->execute();


          //audit logs query
          $ip_address = $_SERVER['REMOTE_ADDR'];
          $user_agent = $_SERVER['HTTP_USER_AGENT'];
          
          $auditstmt = $conn->prepare("INSERT INTO audit_logs (user_id, action_type, action_status, ip_address, user_agent,latitude, longitude, timestamp) VALUES (?, 'login', 'success', ?, ?, ?, ?, NOW())");
          $auditstmt->bind_param("issss", $user['user_id'], $ip_address, $user_agent,$latitude, $longitude);
          $auditstmt->execute();

           
          // ✅ Handle "Remember Me" feature
           if (isset($_POST["remember"])) {
            $token = bin2hex(random_bytes(32)); // Generate secure token
            setcookie("remember_me", $token, time() + (86400 * 30), "/", "", true, true); // Secure cookie

            // Store token in the database
            $stmt = $conn->prepare("UPDATE customer_info SET remember_token = ? WHERE user_id = ?");
            $stmt->bind_param("si", $token, $user['user_id']);
            $stmt->execute();
            }

            // uncomment the below line for real world projects 
            //send mail to denote login to user
          //LoginMailSend($email,$user['name']);

          // Check user role and redirect accordingly
            if ($user['role'] === 'admin') {
                header("Location: admin.php");
            } else {
                header("Location: user_dashboard.php");
            }
            exit();
            
      } else {
         // Failed login attempt
         $stmt = $conn->prepare("INSERT INTO audit_logs (action_type, action_status, ip_address, user_agent, timestamp) VALUES ('login', 'failure', ?, ?, NOW())");
         $stmt->bind_param("ss", $ip_address, $user_agent);
         $stmt->execute();
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