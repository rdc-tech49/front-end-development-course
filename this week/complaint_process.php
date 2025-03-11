<?php

session_start();
include 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $complaint_title = $_POST['complaint_title'];
    $mobile_number = $_POST['mobile_number'];
    $address = $_POST['address'];
    $complaint_message = $_POST['complaint_message'];
    $file_upload = $_FILES['file_upload'];
  

    // Set the maximum allowed file size (in bytes)
    $maxFileSize = 10 * 1024 * 1024;  // 10 MB

    // Check if a file was uploaded
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // File upload data
        $file_upload = $_FILES['file_upload'];
        
        // Check if there was an error uploading the file
        if ($file_upload['error'] != UPLOAD_ERR_OK) {
            echo "Error: " . $file_upload['error'];
            exit;
        }

        // Check if the file size exceeds the limit
        if ($file_upload['size'] > $maxFileSize) {
            echo "Error: The file is too large. Maximum file size is 10 MB.";
            exit;
        }

        // find user
        $user_id = $_SESSION['user_id'];
        $user_name = $_SESSION['user_name'];
        $currentDateTime = date("Y-m-d H:i:s");

        echo $_SESSION['user_id'];
        echo $_SESSION['user_name'];
        echo $_SESSION['email'];
      

        // File upload handling
        $file_name = basename($file_upload["name"]);
        //$file_name =  "$user_id" . "_" . "$user_name" . "_" ."$currentDateTime";

        $target_dir = "uploads/compliants/"; // specify the folder to upload files
        $target_file = $target_dir . $file_name;
        
        // Move the uploaded file to the target directory
        if (move_uploaded_file($file_upload["tmp_name"], $target_file)) {


                // Prepare the SQL query to insert data into the `user_complients` table
                $sql = "INSERT INTO user_complients (complaint_title, mobile_number, address, complaint_message, file_upload)
                VALUES ('$complaint_title', '$mobile_number', '$address', '$complaint_message', '$file_name')";

                // Execute the query
                if ($conn->query($sql) === TRUE) {
                echo "New complaint has been submitted successfully.";
                } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                }

// Close the connection
$conn->close();








            echo "The file has been uploaded successfully.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }






}

?>
