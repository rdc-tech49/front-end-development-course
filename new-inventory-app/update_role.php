<?php
session_start();
$conn = new mysqli("localhost", "root", "", "inventory_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if admin is logged in
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"]) && isset($_POST["new_role"])) {
    $user_id = $_POST["user_id"];
    $new_role = $_POST["new_role"];

    $stmt = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
    $stmt->bind_param("si", $new_role, $user_id);

    if ($stmt->execute()) {
        header("Location: admin.php?success=Role updated successfully");
    } else {
        echo "Error updating role.";
    }
    $stmt->close();
}

$conn->close();
?>
