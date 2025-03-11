<?php
session_start();
require 'vendor/autoload.php'; // Load Dompdf
use Dompdf\Dompdf;
use Dompdf\Options;

include 'database_config.php'; // Database connection

if (!isset($_SESSION['user_id'])) {
    die("Access Denied!");
}

$user_id = $_SESSION['user_id'];
$format = isset($_GET['format']) ? $_GET['format'] : 'pdf';

// Fetch complaints
$sql = "SELECT complaint_number, complaint_title, mobile_number, address, complaint_message, complaint_date, respond_status 
        FROM user_complaints WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$complaints = [];
while ($row = $result->fetch_assoc()) {
    $complaints[] = $row;
}

// Export as PDF using Dompdf with Styling
if ($format === 'pdf') {
    $dompdf = new Dompdf();
    $options = new Options();
    $options->set('defaultFont', 'Helvetica');
    $dompdf->setOptions($options);

    // CSS Styling
    $css = "
        <style>
            body { font-family: Arial, sans-serif; }
            h2 { text-align: center; color: #333; }
            table { width: 100%; border-collapse: collapse; margin-top: 10px; }
            th, td { border: 1px solid #444; padding: 8px; text-align: center; }
            th { background-color: #f2f2f2; font-weight: bold; }
            tr:nth-child(even) { background-color: #f9f9f9; }
        </style>
    ";

    // Table content
    $html = "<h2>My Complaints</h2><table>
                <tr>
                    <th>Complaint No</th>
                    <th>Title</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>";

    foreach ($complaints as $complaint) {
        $html .= "<tr>
                    <td>{$complaint['complaint_number']}</td>
                    <td>{$complaint['complaint_title']}</td>
                    <td>{$complaint['mobile_number']}</td>
                    <td>{$complaint['address']}</td>
                    <td>{$complaint['complaint_message']}</td>
                    <td>" . date("d M Y, h:i A", strtotime($complaint['complaint_date'])) . "</td>
                    <td>{$complaint['respond_status']}</td>
                  </tr>";
    }
    $html .= "</table>";

    // Combine CSS and HTML
    $dompdf->loadHtml($css . $html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream("My_Complaints.pdf", ["Attachment" => 1]); // Force download
    exit();
}

// Export as CSV
elseif ($format === 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="My_Complaints.csv"');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['Complaint No', 'Title', 'Mobile', 'Address', 'Message', 'Date', 'Status']);

    foreach ($complaints as $complaint) {
        fputcsv($output, [
            $complaint['complaint_number'],
            $complaint['complaint_title'],
            $complaint['mobile_number'],
            $complaint['address'],
            $complaint['complaint_message'],
            date("d M Y, h:i A", strtotime($complaint['complaint_date'])),
            $complaint['respond_status']
        ]);
    }
    fclose($output);
    exit();
}
?>
