<?php

session_start();
include 'database_config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php?error=Please log in first.");
        exit();
    }
    // Retrieve form data
    $complaint_title = $_POST['complaint_title'];
    $mobile_number = $_POST['mobile_number'];
    $address = $_POST['address'];
    $complaint_message = $_POST['complaint_message'];
    $file_upload = $_FILES['file_upload'];
  

    // Set allowed file types and max file size (10MB)
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'pdf'];
    $maxFileSize = 10 * 1024 * 1024;

    if ($file_upload['error'] !== UPLOAD_ERR_OK) {
        header("Location: new_complaint.php?error=File upload error.");
        exit();
    }

    // Validate file type
    $file_extension = strtolower(pathinfo($file_upload["name"], PATHINFO_EXTENSION));
    if (!in_array($file_extension, $allowed_extensions)) {
        header("Location: new_complaint.php?error=Invalid file type. Only JPG, PNG, and PDF allowed.");
        exit();
    }

    // Validate file size
    if ($file_upload['size'] > $maxFileSize) {
        header("Location: new_complaint.php?error=File too large. Max size is 10MB.");
        exit();
    }

    // Retrieve logged-in user info
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
    $currentDateTime = date("Y-m-d H:i:s");        

    // Generate a unique complaint number
    $random_number = date('YmdHis');
    $sliced_nuser_name = strtoupper(substr($user_name, 0, 3));
    $complaint_number = $sliced_nuser_name . $user_id . "-" . $random_number;

    // Securely rename file
    $new_file_name = $complaint_number . "." . $file_extension;
    $target_dir = "uploads/complaints/";
    $target_file_path = $target_dir . $new_file_name;

    // Ensure the uploads directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Move uploaded file to server directory
    if (!move_uploaded_file($file_upload["tmp_name"], $target_file_path)) {
        header("Location: new_complaint.php?error=Failed to upload file.");
        exit();
    }


    // Insert complaint into database using prepared statement

    $sql = "INSERT INTO user_complaints (user_id, complaint_number, complaint_title, mobile_number, address, complaint_message, file_upload, complaint_date) 
    VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssss", $user_id, $complaint_number, $complaint_title, $mobile_number, $address, $complaint_message, $target_file_path);

    if ($stmt->execute()) {
        header("Location: user_dashboard.php?complaint_submit_status=" . urlencode("New complaint has been submitted successfully. Your complaint number is $complaint_number"));
        exit();
    } else {
        header("Location: new_complaint.php?error=Database error. Try again.");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>