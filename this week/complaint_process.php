<?php

session_start();
include 'database_config.php';


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
      
        

    // Extract original file name and file extension
    $original_file_name = basename($file_upload["name"]);
    $file_extension = pathinfo($original_file_name, PATHINFO_EXTENSION);
    
  
    $currentDateTime = date('Y-m-d_H-i-s'); // Get the current timestamp (e.g., 2025-03-10_123456)
    $random_number = date('YmdHis');
    
    // Generate a new compliant number
    $sliced_nuser_name = substr($user_name, 0, 3);
    $uc_user_name = strtoupper($sliced_nuser_name);
    $compliant_number  = $uc_user_name.$user_id."-".$random_number;
    
    // Create the new file name (including the extension)
    // $new_file_name = $user_id . "_" . $user_name . "_" . $currentDateTime . "." . $file_extension;

    $new_file_name = $compliant_number ."." . $file_extension;


    // Specify the target directory where the file will be uploaded
    $target_dir = "uploads/compliants/";

    // Full path to the target file (including renamed file name)
    $target_file_path = $target_dir . $new_file_name;

    // echo $file_upload["tmp_name"];
    
    // print_r($file_upload);
    // exit();


    // Check if the file is uploaded and move it to the target directory
    if (move_uploaded_file($file_upload["tmp_name"], $target_file_path)) {


                // Prepare the SQL query to insert data into the `user_complients` table
                $sql = "INSERT INTO user_complaints (user_id,complaint_number,complaint_title, mobile_number, address, complaint_message, file_upload)
                VALUES ('$user_id','$compliant_number','$complaint_title', '$mobile_number', '$address', '$complaint_message', '$target_file_path')";

                // Execute the query
                if ($conn->query($sql) === TRUE) {
                    $complaint_submit_status = "New complaint has been submitted successfully";
                    header("Location: user_dashboard.php?complaint_submit_status= $complaint_submit_status");
                // echo "New complaint has been submitted successfully.";
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
