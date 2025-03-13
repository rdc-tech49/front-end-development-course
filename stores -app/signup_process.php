<?php
include 'database_config.php';
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Get form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $pass = $_POST['password'];
  
  // Validate input (prevent SQL Injection)
  $name = $conn->real_escape_string($name);
  $email = $conn->real_escape_string($email);
  $pass = $conn->real_escape_string($pass);

  // Hash the password for security
  $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

  // Check if email already exists
  $check_sql = "SELECT * FROM users WHERE email='$email'";
  $check_result = $conn->query($check_sql);

  if ($check_result->num_rows > 0) {
      
      $response_msg = "This email is already registered.";
      header("Location: signup.php?signup_status=$response_msg");
  } else {
      // Insert user data into database
      $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";

      if ($conn->query($sql) === TRUE) {
        //registration mail send to user
        registrationMailSend($email,$name);

        $signup_status = "Signup Success! Enter Email and Password";
        header("Location: index.php?signup_status= $signup_status");
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
  // Close the connection
  $conn->close();
}

?>
