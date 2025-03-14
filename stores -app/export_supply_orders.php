<?php
require 'vendor/autoload.php'; // Include DOMPDF (if using Composer)
require 'database_config.php'; // Your database connection

use Dompdf\Dompdf;
use Dompdf\Options;

// Fetch data from `items-to-be-supplied` table
$query = "SELECT * FROM items_to_be_supplied";
$result = $conn->query($query);

$html = '<h2 style="text-align:center;">Items to be Supplied</h2>';
$html .= '<table border="1" cellspacing="0" cellpadding="5" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Model</th>
                    <th>Quantity</th>
                    <th>Purchased date</th>
                </tr>
            </thead>
            <tbody>';

while ($row = $result->fetch_assoc()) {
    $html .= '<tr>
                <td>' . $row['id'] . '</td>
                <td>' . htmlspecialchars($row['item_name']) . '</td>
                <td>' . htmlspecialchars($row['item_model']) . '</td>
                <td>' . $row['quantity'] . '</td>
                <td>' . htmlspecialchars($row['items_purchased_date']) . '</td>

              </tr>';
}

$html .= '</tbody></table>';

// Initialize DOMPDF
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Download PDF
$dompdf->stream("items_to_be_supplied.pdf", ["Attachment" => true]);
?>
