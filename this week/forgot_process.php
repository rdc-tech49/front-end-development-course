<?php
session_start();
include "database_config.php"; // Contains your $conn (database connection)
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $dob = trim($_POST['dob']);
    
    // Check if a record exists with the provided email and age
    $stmt = $conn->prepare("SELECT user_id, name FROM customer_info WHERE email = ? AND date_of_birth = ?");
    $stmt->bind_param("ss", $email, $dob);
    $stmt->execute();
    $result = $stmt->get_result();
    
    
    if ($result->num_rows ==1) {
        $user = $result->fetch_assoc();
        $user_id = $user['user_id'];
        $name = $user['name'];
        
        // Generate a secure token and set an expiration (e.g., 1 hour from now)
        $token = bin2hex(random_bytes(50));
        $expires = date("Y-m-d H:i:s", strtotime("+12 hour"));
        
        // Update the database with the token and its expiration
        $update_stmt = $conn->prepare("UPDATE customer_info SET reset_token = ?, reset_expires = ? WHERE user_id = ?");
        $update_stmt->bind_param("ssi", $token, $expires, $user_id);
        $update_stmt->execute();
        
        // Create the password reset link (adjust your domain accordingly)
        $reset_link = "http://localhost/front-end-development-course/this%20week/reset_password.php?token=" . $token;
        
        // Prepare the email content
        $to = $email;
        // $subject = "Password Reset Request";
        // $message = "Hello $name,\n\nWe received a request to reset your password. Please click the link below to reset your password:\n\n$reset_link\n\nIf you did not request a password reset, please ignore this email.\n\nRegards,\nRDC-Tech Team";
        // $headers = "From: no-reply@rdc-tech.com";
        
        

        // Send the email (ensure your server is configured to send mail)
        ResetMailSend($to,$name,$reset_link);
        $_SESSION['message'] = "A password reset link has been sent to your email.";
        
        // if (mail($to, $subject, $message, $headers)) {
        //     $_SESSION['message'] = "A password reset link has been sent to your email.";
        // } else {
        //     $_SESSION['message'] = "Failed to send password reset email. Please try again later.";
        // }
    } else {
        $_SESSION['message'] = "No account found matching the provided email and date of birth.";
    }
    
    header("Location: forgot.php");
    exit();
} else {
    header("Location: forgot.php");
    exit();
}
?>
