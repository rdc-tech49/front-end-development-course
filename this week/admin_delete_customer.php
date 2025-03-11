<?php
session_start();
include 'database_config.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: user_dashboard.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: admin.php?error=Missing customer id");
    exit();
}

$customer_id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM customer_info WHERE user_id=?");
$stmt->bind_param("i", $customer_id);
if ($stmt->execute()) {
    header("Location: admin.php?message=Customer deleted successfully");
    exit();
} else {
    echo "Error deleting customer: " . $conn->error;
}
?>
