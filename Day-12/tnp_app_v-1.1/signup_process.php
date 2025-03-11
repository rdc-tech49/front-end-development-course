<!-- filepath: c:\xampp\htdocs\police_training\police_training\process_signup.php -->
<?php
include 'config.php';
include 'functions.php';

//if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];

    //    $username = "name1";
    // $email = "harishankar@nielitchennai.edu.in";
    // $password = 123;
    // $confirm_password = 123;
    // $dob = "2025-03-10";
    // $gender = "male";



    // Check if any of the required fields are empty
    if ($username != "" && $email != "" && $password !="" && $confirm_password !="" && $dob !="" && $gender !="") {
        
        
        // Check if the password and confirm password match
        if ($password !== $confirm_password) {
            //echo "Password and confirm password do not match!";
            $response_msg = "Password and confirm password do not match!";
            header("Location: signup.php?signup_status=$response_msg");

        } else {

            // Proceed with the signup process 
            // Check if the user already exists
            $sql = "SELECT * FROM user_info WHERE  email='$email'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $response_msg = "This email is already registered.";
                header("Location: signup.php?signup_status=$response_msg");
            } else {
                // Insert the data into the database
                $sql = "INSERT INTO user_info (user_name, email, password,  dob, gender) VALUES ('$username', '$email', '$password', '$dob', '$gender')";
                if (mysqli_query($conn, $sql)) {

                    //registration mail send to user
                    registrationMailSend($email,$username);

                    $signup_status = "Signup Success! Please Enter Email & Password";
                    header("Location: login.php?signup_status= $signup_status");
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }

           mysqli_close($conn);

            echo "Signup successful!";
        }
        
        
        
        
   
    } else {
        
         //echo "All fields are required!";
         //$response_msg = "All fields are required";
         header("Location: signup.php?signup_status=All fields are required");
            


    }

   






//}
?>