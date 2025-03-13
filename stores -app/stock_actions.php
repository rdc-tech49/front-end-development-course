<?php
include 'database_config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Fetch stock details (equivalent to get_stock.php)
    $id = $_GET['id'];
    $query = "SELECT * FROM stock_received WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    echo json_encode($result->fetch_assoc());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === "update") {
        // Update stock details (equivalent to update_stock.php)
        $id = $_POST['id'];
        $item_name = $_POST['item_name'];
        $item_model = $_POST['item_model'];
        $item_quantity = $_POST['item_quantity'];

        $query = "UPDATE stock_received SET item_name = ?, item_model = ?, item_quantity = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssii", $item_name, $item_model, $item_quantity, $id);

        if ($stmt->execute()) {
            echo "Stock updated successfully!";
        } else {
            echo "Error updating stock.";
        }
    } elseif ($action === "delete") {
        // Delete stock (equivalent to delete_stock.php)
        $id = $_POST['id'];
        $query = "DELETE FROM stock_received WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Stock deleted successfully!";
        } else {
            echo "Error deleting stock.";
        }
    }
}
?>
