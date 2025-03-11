<?php
session_start();
$servername = "localhost";
$username = "root"; // Default MySQL user
$password = "chander"; // Default password (for XAMPP, WAMP)
$dbname = "customers";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['password'];
$dob = $_POST['dob'];

// Validate input (prevent SQL Injection)
$name = $conn->real_escape_string($name);
$email = $conn->real_escape_string($email);
$dob = $conn->real_escape_string($dob);
$pass = $conn->real_escape_string($pass);

// Hash the password for security
$hashed_password = password_hash($pass, PASSWORD_DEFAULT);

// Check if email already exists
$check_sql = "SELECT * FROM customer_info WHERE email='$email'";
$check_result = $conn->query($check_sql);

if ($check_result->num_rows > 0) {
    echo "Error: Email already registered!";
} else {
    // Insert user data into database
    $sql = "INSERT INTO customer_info (name, email, password, date_of_birth) VALUES ('$name', '$email', '$hashed_password', '$dob')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.html?success=1");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
