<?php
session_start();
include "database_config.php"; // Contains your $conn

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $token = $_POST['token'];
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);
    echo "$new_password";

    // Ensure both passwords match
    if($new_password !== $confirm_password){
        $_SESSION['message'] = "Passwords do not match.";
        header("Location: reset_password.php?token=" . urlencode($token));
        exit();
    }
    

    // Verify the token once more
    $stmt = $conn->prepare("SELECT user_id, reset_expires FROM customer_info WHERE reset_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows != 1){
        $_SESSION['message'] = "Invalid token.";
        header("Location: forgot.php");
        exit();
    }
    
    $user = $result->fetch_assoc();
    $expires = $user['reset_expires'];
    
    if(strtotime($expires) < time()){
        $_SESSION['message'] = "Token has expired. Please request a new password reset.";
        header("Location: forgot.php");
        exit();
    }
    
    // Hash the new password securely
    $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
    
    // Update the password and clear the reset token and expiration
    $update_stmt = $conn->prepare("UPDATE customer_info SET password = ?, reset_token = NULL, reset_expires = NULL WHERE user_id = ?");
    $update_stmt->bind_param("si", $new_password_hash, $user['user_id']);
    
    if($update_stmt->execute()){

        $reset_status = "Password reset successfully. Login to continue.";
        header("Location: login.php?reset_status= $reset_status");

        // Insert reset log
        $logQuery = "INSERT INTO password_reset_logs (user_id) VALUES (?)";
        $logStmt = $conn->prepare($logQuery);
        $logStmt->bind_param("i", $user['user_id']);
        $logStmt->execute();

        //
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $prstmt = $conn->prepare("INSERT INTO audit_logs (user_id, action_type, action_status, ip_address, user_agent) VALUES (?, 'password_reset', 'success', ?, ?)");
        $prstmt->bind_param("iss", $user['user_id'], $ip_address, $user_agent);
        $prstmt->execute();

        exit();
    } else {
        $_SESSION['message'] = "Failed to reset password. Please try again.";
        header("Location: reset_password.php?token=" . urlencode($token));
        exit();
    }
} else {
    header("Location: forgot.php");
    exit();
}
?>
