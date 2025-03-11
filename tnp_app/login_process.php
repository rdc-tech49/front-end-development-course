<?php
include 'config.php';
session_start();
 // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email1'];
    $password = $_POST['password'];

    // Create a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM user_info WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
     
        $user = $result->fetch_assoc();
     
       
        // Compare the plain text passwords directly
        if ($password == $user['password']) {
            // Password is correct, set session variables and redirect to user_dashboard.php
            
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['user_name'];
           
            // echo $_SESSION['user_id'];
            echo $_SESSION['user_name'];
            echo $_SESSION['email'];
            

            header("Location: user_dashboard.php");
           
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