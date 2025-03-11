<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "chander";
$dbname = "customers";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

echo "Connected successfully";

// Get form data
$user = $_POST['Email'];
$pass = $_POST['Password'];


// Validate input (prevent SQL Injection)
$user = $conn->real_escape_string($user);
$pass = $conn->real_escape_string($pass);

// Check if user exists in the database (using password function)




$sql = "SELECT * FROM users WHERE Email='$user' AND Password='$pass'";
$result = $conn->query($sql);

if ($result -> num_rows > 0) {
    $_SESSION['Email'] = $user; // Store username in session
    echo "Login successful! Welcome, " . $_SESSION['Email'];
} else {
    echo "Invalid username or password!";
}

// $conn->close();
?>