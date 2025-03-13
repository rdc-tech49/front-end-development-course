<?php

$servername = "localhost";
$username = "root"; // Default MySQL user
$password = ""; // Default password (for XAMPP, WAMP)
$dbname = "inventory_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>