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
$email = $_POST['email'];
$pass = $_POST['password'];
$rememberMe = isset($_POST['rememberMe']); // Check if checkbox is checked

// Validate input (prevent SQL Injection)
$email = $conn->real_escape_string($email);
$pass = $conn->real_escape_string($pass);

// Check if email exists
$sql = "SELECT * FROM customer_info WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Verify password
    if (password_verify($pass, $row['password'])) {
        $_SESSION['user'] = $row['name']; // Store session
        if ($rememberMe) {
            setcookie("email", $email, time() + (30 * 24 * 60 * 60), "/"); // 30 days
            setcookie("password", $hashedPassword, time() + (30 * 24 * 60 * 60), "/"); // 30 days
        }
        header("Location: success.php"); // Redirect to success page
        exit();
    } else {
        header("Location: index.html?error=Incorrect password!"); // Redirect with error
        exit();
    }
} else {
    header("Location: index.html?error=Email not found! Please Sign Up"); // Redirect with error
    exit();
}

$conn->close();
?>
