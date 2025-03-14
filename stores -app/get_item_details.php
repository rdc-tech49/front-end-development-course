<?php
// Enable error reporting for debugging (Remove in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json'); // Ensure JSON response

include 'database_config.php'; // Database connection

$response = [];

if (isset($_GET['item_name']) && isset($_GET['type'])) {
    $item_name = $_GET['item_name'];

    if ($_GET['type'] === 'models') {
        // ✅ Fetch models for the selected item
        $query = "SELECT DISTINCT item_model FROM items_to_be_supplied WHERE item_name = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $item_name);
        $stmt->execute();
        $result = $stmt->get_result();

        $models = [];
        while ($row = $result->fetch_assoc()) {
            $models[] = $row['item_model'];
        }
        $response['models'] = $models;

    } elseif ($_GET['type'] === 'quantity' && isset($_GET['item_model'])) {
        $item_model = $_GET['item_model'];

        // ✅ Fetch available quantity for selected item and model
        $query = "SELECT SUM(quantity) AS total_quantity FROM items_to_be_supplied WHERE item_name = ? AND item_model = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $item_name, $item_model);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
        $total_quantity = $row['total_quantity'] ?? 0;

        // Generate quantity dropdown options (1 to available quantity)
        $quantityOptions = [];
        for ($i = 1; $i <= $total_quantity; $i++) {
            $quantityOptions[] = $i;
        }

        $response['quantity'] = $total_quantity;
        $response['quantityOptions'] = $quantityOptions;
    }
} else {
    $response['error'] = "Invalid request";
}

echo json_encode($response);
?>
