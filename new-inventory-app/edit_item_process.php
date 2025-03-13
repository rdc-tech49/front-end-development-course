<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $conn = new mysqli("localhost", "root", "", "inventory_db");
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    
    $stmt = $conn->prepare("UPDATE items SET product_name = ?, quantity = ?, price = ? WHERE id = ?");
    $stmt->bind_param("sidi", $product_name, $quantity, $price, $id);
    if($stmt->execute()){
        header("Location: view_items.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
} else {
    header("Location: view_items.php");
    exit();
}
?>
