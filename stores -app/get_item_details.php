<?php
include 'database_config.php';

if (isset($_GET['item_name'])) {
    $item_name = $_GET['item_name'];

    // Fetch item models based on the selected item
    $queryModels = "SELECT DISTINCT item_model FROM items_to_be_supplied WHERE item_name = ?";
    $stmtModels = $conn->prepare($queryModels);
    $stmtModels->bind_param("s", $item_name);
    $stmtModels->execute();
    $resultModels = $stmtModels->get_result();

    $models = [];
    while ($row = $resultModels->fetch_assoc()) {
        $models[] = $row['item_model'];
    }

    // Fetch available quantity for the selected item
    $queryQuantity = "SELECT SUM(quantity) as available_quantity FROM items_to_be_supplied WHERE item_name = ?";
    $stmtQuantity = $conn->prepare($queryQuantity);
    $stmtQuantity->bind_param("s", $item_name);
    $stmtQuantity->execute();
    $resultQuantity = $stmtQuantity->get_result();
    $quantityRow = $resultQuantity->fetch_assoc();

    $response = [
        "models" => $models,
        "available_quantity" => $quantityRow['available_quantity'] ?? 0
    ];

    echo json_encode($response);
}
?>
