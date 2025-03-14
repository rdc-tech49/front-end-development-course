<?php
include 'database_config.php'; // Ensure this includes the correct database connection

header('Content-Type: application/json');

// ✅ First Query: Total Stock Report (for Bar & Pie Chart)
$query = "
    SELECT sr.item_name, 
       SUM(sr.item_quantity) AS quantity_received, 
       COALESCE((SELECT SUM(isup.quantity) FROM item_supplied isup WHERE isup.item_name = sr.item_name), 0) AS quantity_supplied,
       COALESCE((SELECT SUM(its.quantity) FROM items_to_be_supplied its WHERE its.item_name = sr.item_name), 0) AS items_to_be_supplied
    FROM stock_received sr
    GROUP BY sr.item_name;
";

$result = $conn->query($query);

$stock_data = [
    "item_names" => [],
    "quantity_received" => [],
    "quantity_supplied" => [],
    "items_to_be_supplied" => []
];

while ($row = $result->fetch_assoc()) {
    $stock_data["item_names"][] = $row["item_name"];
    $stock_data["quantity_received"][] = (int) $row["quantity_received"];
    $stock_data["quantity_supplied"][] = (int) $row["quantity_supplied"];
    $stock_data["items_to_be_supplied"][] = (int) $row["items_to_be_supplied"];
}

// ✅ Second Query: User-wise Item Supply Report (for Separate Bar Charts)
$sql = "
    SELECT 
        s.item_name, 
        u.name AS supplied_to, 
        COALESCE(SUM(s.quantity), 0) AS quantity_supplied
    FROM item_supplied s
    JOIN users u ON s.supplied_to = u.name
    GROUP BY s.item_name, u.name
    ORDER BY s.item_name, u.name;
";

$result2 = $conn->query($sql);

$user_supply_data = [];

while ($row = $result2->fetch_assoc()) {
    $item_name = $row['item_name'];

    if (!isset($user_supply_data[$item_name])) {
        $user_supply_data[$item_name] = [
            'users' => [],
            'quantities' => []
        ];
    }

    $user_supply_data[$item_name]['users'][] = $row['supplied_to']; 
    $user_supply_data[$item_name]['quantities'][] = (int) $row['quantity_supplied'];
}

// ✅ Ensure only ONE JSON response
echo json_encode([
    "status" => "success",
    "stock_data" => $stock_data, 
    "user_supply_data" => $user_supply_data
]);

$conn->close();
?>
