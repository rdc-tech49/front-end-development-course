<?php
include 'database_config.php';

// Fetch consolidated stock data
$query = "SELECT sr.item_name, sr.item_quantity AS quantity_received, 
                 COALESCE(isup.quantity, 0) AS quantity_supplied, 
                 (sr.item_quantity - COALESCE(isup.quantity, 0)) AS quantity_in_stock
          FROM stock_received sr
          LEFT JOIN (
              SELECT item_name, SUM(quantity) AS quantity 
              FROM item_supplied 
              GROUP BY item_name
          ) isup ON sr.item_name = isup.item_name";
$result = $conn->query($query);

$item_names = [];
$quantity_received = [];
$quantity_supplied = [];
$quantity_in_stock = [];

while ($row = $result->fetch_assoc()) {
    $item_names[] = $row['item_name'];
    $quantity_received[] = $row['quantity_received'];
    $quantity_supplied[] = $row['quantity_supplied'];
    $quantity_in_stock[] = $row['quantity_in_stock'];
}

// Fetch supply trends
$query = "SELECT supplied_date, COUNT(*) AS supply_count FROM item_supplied GROUP BY supplied_date ORDER BY supplied_date";
$result = $conn->query($query);

$supply_dates = [];
$supply_counts = [];

while ($row = $result->fetch_assoc()) {
    $supply_dates[] = $row['supplied_date'];
    $supply_counts[] = $row['supply_count'];
}

// Return JSON response
echo json_encode([
    "item_names" => $item_names,
    "quantity_received" => $quantity_received,
    "quantity_supplied" => $quantity_supplied,
    "quantity_in_stock" => $quantity_in_stock,
    "supply_dates" => $supply_dates,
    "supply_counts" => $supply_counts
]);

$conn->close();
?>
