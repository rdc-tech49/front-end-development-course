<?php
include 'database_config.php';
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Get form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $pass = $_POST['password'];
  $dob = $_POST['dob'];
  $gender = $_POST['gender'];
  $designation = $_POST['designation'];
  // Validate input (prevent SQL Injection)
  $name = $conn->real_escape_string($name);
  $email = $conn->real_escape_string($email);
  $dob = $conn->real_escape_string($dob);
  $pass = $conn->real_escape_string($pass);
  $gender = $conn->real_escape_string($gender);
  $designation = $conn->real_escape_string($designation);
  // Hash the password for security
  $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

  // Check if email already exists
  $check_sql = "SELECT * FROM customer_info WHERE email='$email'";
  $check_result = $conn->query($check_sql);

  if ($check_result->num_rows > 0) {
      
      $response_msg = "This email is already registered.";
      header("Location: signup.php?signup_status=$response_msg");
  } else {
      // Insert user data into database
      $sql = "INSERT INTO customer_info (name, email, password, date_of_birth, gender, designation) VALUES ('$name', '$email', '$hashed_password', '$dob','$gender','$designation')";

      if ($conn->query($sql) === TRUE) {
        //registration mail send to user
        registrationMailSend($email,$name);

        $signup_status = "Signup Success! Enter Email and Password";
        header("Location: login.php?signup_status= $signup_status");
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
  // Close the connection
  $conn->close();
}

?>
