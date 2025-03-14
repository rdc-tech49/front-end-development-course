<?php
include 'database_config.php';

$query = "
    SELECT 
        sr.id AS serial_no, 
        sr.item_name, 
        sr.item_model, 
        sr.item_quantity AS quantity_received, 
        IFNULL(SUM(isup.quantity), 0) AS quantity_supplied, 
        its.quantity AS quantity_in_stock
    FROM stock_received sr
    LEFT JOIN item_supplied isup ON sr.item_name = isup.item_name AND sr.item_model = isup.item_model
    LEFT JOIN items_to_be_supplied its ON sr.item_name = its.item_name AND sr.item_model = its.item_model
    GROUP BY sr.id, sr.item_name, sr.item_model, sr.item_quantity, its.quantity
";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $stock_class = ($row['quantity_in_stock'] == 0) ? 'table-success' : (($row['quantity_in_stock'] < 5) ? 'table-danger' : '');

        echo "<tr class='$stock_class'>";
        echo "<td>{$row['serial_no']}</td>";
        echo "<td>{$row['item_name']}</td>";
        echo "<td>{$row['item_model']}</td>";
        echo "<td>{$row['quantity_received']}</td>";
        echo "<td>{$row['quantity_supplied']}</td>";
        echo "<td>{$row['quantity_in_stock']}</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6' class='text-center'>No stock data available</td></tr>";
}
?>
