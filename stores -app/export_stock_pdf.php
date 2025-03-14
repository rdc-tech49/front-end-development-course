<?php
require 'vendor/autoload.php';
include 'database_config.php'; // Your DB connection

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('defaultFont', 'Arial');

$dompdf = new Dompdf($options);

// Fetch consolidated stock data
$query = "SELECT sr.id, sr.item_name, sr.item_model, 
                 sr.item_quantity AS quantity_received, 
                 IFNULL(isup.quantity, 0) AS quantity_supplied, 
                 IFNULL(its.quantity, 0) AS quantity_in_stock
          FROM stock_received sr
          LEFT JOIN item_supplied isup ON sr.item_name = isup.item_name AND sr.item_model = isup.item_model
          LEFT JOIN items_to_be_supplied its ON sr.item_name = its.item_name AND sr.item_model = its.item_model";

$result = $conn->query($query);

$html = '<h2>Consolidated Stock Report</h2>
        <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>Serial No</th>
                <th>Item Name</th>
                <th>Item Model</th>
                <th>Quantity Received</th>
                <th>Quantity Supplied</th>
                <th>Quantity In Stock</th>
            </tr>
        </thead>
        <tbody>';

while ($row = $result->fetch_assoc()) {
    $html .= "<tr>
                <td>{$row['id']}</td>
                <td>{$row['item_name']}</td>
                <td>{$row['item_model']}</td>
                <td>{$row['quantity_received']}</td>
                <td>{$row['quantity_supplied']}</td>
                <td>{$row['quantity_in_stock']}</td>
              </tr>";
}

$html .= '</tbody></table>';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("Stock_Report.pdf", ["Attachment" => 1]);
?>
