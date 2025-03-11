<?php
session_start();
include 'database_config.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: user_dashboard.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: admin.php?error=Missing complaint id");
    exit();
}

$complaint_id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM user_complaints WHERE id=?");
$stmt->bind_param("i", $complaint_id);
if ($stmt->execute()) {
    header("Location: admin.php?message=Complaint deleted successfully");
    exit();
} else {
    echo "Error deleting complaint: " . $conn->error;
}
?>
