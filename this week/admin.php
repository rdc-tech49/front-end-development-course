<?php
session_start();
include 'database_config.php';

// Check if user is logged in and has admin role
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: user_dashboard.php");
    exit();
}

// Get total customers
$queryCustomers = "SELECT COUNT(*) as total_customers FROM customer_info";
$resultCustomers = $conn->query($queryCustomers);
$rowCustomers = $resultCustomers->fetch_assoc();
$total_customers = $rowCustomers['total_customers'];

// Get total complaints
$queryComplaints = "SELECT COUNT(*) as total_complaints FROM user_complaints";
$resultComplaints = $conn->query($queryComplaints);
$rowComplaints = $resultComplaints->fetch_assoc();
$total_complaints = $rowComplaints['total_complaints'];

// Retrieve all customers details
$queryAllCustomers = "SELECT user_id, name, email, role FROM customer_info";
$resultAllCustomers = $conn->query($queryAllCustomers);

// Retrieve all complaints details
$queryAllComplaints = "SELECT id, user_id, complaint_number, complaint_title, mobile_number, address, complaint_message, complaint_date, respond_status FROM user_complaints";
$resultAllComplaints = $conn->query($queryAllComplaints);


//fetch login logs
$queryLoginLogs = "SELECT login_logs.id, login_logs.login_time, login_logs.ip_address, login_logs.user_agent, customer_info.name, customer_info.email 
                   FROM login_logs 
                   JOIN customer_info ON login_logs.user_id = customer_info.user_id 
                   ORDER BY login_logs.login_time DESC";
$resultLoginLogs = $conn->query($queryLoginLogs);


//fetch password reset logs
$queryResetLogs = "SELECT password_reset_logs.id, password_reset_logs.reset_time, customer_info.name, customer_info.email 
                   FROM password_reset_logs 
                   JOIN customer_info ON password_reset_logs.user_id = customer_info.user_id 
                   ORDER BY password_reset_logs.reset_time DESC";
$resultResetLogs = $conn->query($queryResetLogs);

//
// Fetch audit logs
$auditqueryLogs = "SELECT a.id, c.name, c.email, a.action_type, a.action_status, a.ip_address, a.user_agent, a.latitude, a.longitude, a.timestamp AS login_time, a.logout_time
              FROM audit_logs a
              LEFT JOIN customer_info c ON a.user_id = c.user_id
              WHERE a.action_type = 'login'
              ORDER BY a.timestamp DESC";
$auditresultLogs = $conn->query($auditqueryLogs);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <!-- Using Bootstrap 5 for styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Scrollable table container: adjust max-height as needed */
        .scrollable-table {
            max-height: 400px; /* Approximately fits 10 rows */
            overflow-y: auto;
        }
    </style>
    <link rel="stylesheet" href="admin.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm67Ydt--cSwJYRJRLynO7PEqzmge7y6A&callback=initMap" async defer></script>

</head>
<body>
<?php include "header.php"; ?>
<div class="container mt-5 pt-5 mb-5 pb-5">
    <h1 class="mt-5">Admin Dashboard</h1>

    <!-- Statistics Cards -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Customers Registered</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $total_customers; ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Total Complaints Registered</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $total_complaints; ?></h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Customers Table with Search (if needed) -->
    <h2 class="mt-5">Customers Details</h2>
    <!-- Optionally add a search box here if desired -->
    <div class="scrollable-table">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php while($customer = $resultAllCustomers->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $customer['user_id']; ?></td>
                    <td><?php echo htmlspecialchars($customer['name']); ?></td>
                    <td><?php echo htmlspecialchars($customer['email']); ?></td>
                    <td><?php echo htmlspecialchars($customer['role']); ?></td>
                    <td>
                        <a href="admin_edit_customer.php?id=<?php echo $customer['user_id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="admin_delete_customer.php?id=<?php echo $customer['user_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this customer?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Complaints Table with Search (if needed) -->
    <h2 class="mt-5">Complaints Details</h2>
    <!-- Optionally add a search box here if desired -->
    <div class="scrollable-table">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Complaint Number</th>
                    <th>Title</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php while($complaint = $resultAllComplaints->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $complaint['id']; ?></td>
                    <td><?php echo $complaint['user_id']; ?></td>
                    <td><?php echo htmlspecialchars($complaint['complaint_number']); ?></td>
                    <td><?php echo htmlspecialchars($complaint['complaint_title']); ?></td>
                    <td><?php echo htmlspecialchars($complaint['mobile_number']); ?></td>
                    <td><?php echo htmlspecialchars($complaint['address']); ?></td>
                    <td><?php echo htmlspecialchars($complaint['complaint_message']); ?></td>
                    <td><?php echo date("d M Y, h:i A", strtotime($complaint['complaint_date'])); ?></td>
                    <td><?php echo htmlspecialchars($complaint['respond_status']); ?></td>
                    <td>
                        <a href="admin_edit_complaint.php?id=<?php echo $complaint['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="admin_delete_complaint.php?id=<?php echo $complaint['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this complaint?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <h2 class="mt-5">Login Logs</h2>
    <div class="scrollable-table">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Login Time</th>
                    <th>IP Address</th>
                    <th>User Agent</th>
                </tr>
            </thead>
            <tbody>
            <?php while($log = $resultLoginLogs->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $log['id']; ?></td>
                    <td><?php echo htmlspecialchars($log['name']); ?></td>
                    <td><?php echo htmlspecialchars($log['email']); ?></td>
                    <td><?php echo date("d M Y, h:i A", strtotime($log['login_time'])); ?></td>
                    <td><?php echo htmlspecialchars($log['ip_address']); ?></td>
                    <td><?php echo htmlspecialchars($log['user_agent']); ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <h2 class="mt-5">Password Reset Logs</h2>
    <div class="scrollable-table">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Reset Time</th>
                </tr>
            </thead>
            <tbody>
            <?php while($log = $resultResetLogs->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $log['id']; ?></td>
                    <td><?php echo htmlspecialchars($log['name']); ?></td>
                    <td><?php echo htmlspecialchars($log['email']); ?></td>
                    <td><?php echo date("d M Y, h:i A", strtotime($log['reset_time'])); ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <h2 class="mt-5">Audit Logs</h2>
<div class="scrollable-table">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Email</th>
                <th>Login Time</th>
                <th>Logout Time</th>
                <th>IP Address</th>
                <th>User Agent</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php while($log = $auditresultLogs->fetch_assoc()): ?>
            <tr>
                <td><?php echo $log['id']; ?></td>
                <td><?php echo htmlspecialchars($log['name']); ?></td>
                <td><?php echo htmlspecialchars($log['email']); ?></td>
                <td><?php echo date("d M Y, h:i A", strtotime($log['login_time'])); ?></td>
                <td><?php echo $log['logout_time'] ? date("d M Y, h:i A", strtotime($log['logout_time'])) : 'Still Logged In'; ?></td>
                <td><?php echo htmlspecialchars($log['ip_address']); ?></td>
                <td><?php echo htmlspecialchars($log['user_agent']); ?></td>
                <td><?php echo htmlspecialchars($log['latitude']); ?></td>
                <td><?php echo htmlspecialchars($log['longitude']); ?></td>
                <td>
    <a href="https://www.google.com/maps?q=<?php echo $log['latitude']; ?>,<?php echo $log['longitude']; ?>" target="_blank">
        <?php echo $log['latitude'] . ', ' . $log['longitude']; ?>
    </a>
</td>
                <td><?php echo htmlspecialchars($log['action_status']); ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>


<?php
include 'database_config.php';

$today = date('Y-m-d');

$query = "SELECT latitude, longitude, user_id, ip_address, timestamp FROM audit_logs WHERE DATE(timestamp) = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $today);
$stmt->execute();
$result = $stmt->get_result();

$locations = [];
while ($row = $result->fetch_assoc()) {
    if (!empty($row['latitude']) && !empty($row['longitude'])) {
        $locations[] = [
            'lat' => (float)$row['latitude'],
            'lng' => (float)$row['longitude'],
            'name' => $row['user_id'],
            'ip' => $row['ip_address'],
            'login_time' => date("d M Y, h:i A", strtotime($row['timestamp']))
        ];
    }
}
?>
<h2 class="mt-5">Login Locations for Today</h2>
<div id="map" style="width: 80%; height: 500px;"></div>

</div>
<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 3, // Adjust the zoom level as needed
            center: { lat: 20.5937, lng: 78.9629 } // Default to center of the world (India as example)
        });

        var locations = <?php echo json_encode($locations); ?>;
        if (locations.length === 0) {
            console.log("No login locations available for today.");
            return;
        }
        locations.forEach(function (location) {
            var marker = new google.maps.Marker({
                position: { lat: location.lat, lng: location.lng },
                map: map
            });

            var infoWindow = new google.maps.InfoWindow({
                content: `<strong>${location.name}</strong><br>IP: ${location.ip}<br>Login: ${location.login_time}`
            });

            marker.addListener('click', function () {
                infoWindow.open(map, marker);
            });
        });
        // Auto-center map to fit all markers
        var bounds = new google.maps.LatLngBounds();
        locations.forEach(loc => bounds.extend(new google.maps.LatLng(loc.lat, loc.lng)));
        map.fitBounds(bounds);
    }
</script>
</body>
</html>
