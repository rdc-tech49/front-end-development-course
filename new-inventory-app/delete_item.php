<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $conn = new mysqli("localhost", "root", "", "inventory_db");
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("DELETE FROM items WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
header("Location: view_items.php");
exit();
?>
