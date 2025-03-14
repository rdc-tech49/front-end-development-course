<?php
require 'vendor/autoload.php'; // If using Composer
require 'database_config.php'; // Database connection

use Dompdf\Dompdf;
use Dompdf\Options;

// Fetch data from items_supplied table
$query = "SELECT * FROM item_supplied";
$result = $conn->query($query);

$html = '<h2 style="text-align:center;">Items Supplied</h2>';
$html .= '<table border="1" cellspacing="0" cellpadding="5" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Model</th>
                    <th>Quantity</th>
                    <th>Supply Date</th>
                    <th>Supplied To</th>
                    <th>Received By</th>

                </tr>
            </thead>
            <tbody>';

while ($row = $result->fetch_assoc()) {
    //$lowStockStyle = ($row['quantity'] <= 5) ? 'style="background-color:#ffcccc;"' : ''; 
    // Low stock highlight
    // $html .= '<tr ' . $lowStockStyle . '>

    $html .= '<tr>
                <td>' . $row['id'] . '</td>
                <td>' . htmlspecialchars($row['item_name']) . '</td>
                <td>' . htmlspecialchars($row['item_model']) . '</td>
                <td>' . $row['quantity'] . '</td>
                <td>' . htmlspecialchars($row['supplied_date']) . '</td>
                <td>' . htmlspecialchars($row['supplied_to']) . '</td>
                <td>' . date("d M Y", strtotime($row['received_person_name'])) . '</td>
              </tr>';
}

$html .= '</tbody></table>';

// Initialize DOMPDF
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

// Download PDF
$dompdf->stream("items_supplied.pdf", ["Attachment" => true]);
?>
