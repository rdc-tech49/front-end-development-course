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
</head>
<body>
<?php include "header.php"; ?>
<div class="container mt-5 pt-5">
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
    <h2>Customers Details</h2>
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
    <h2>Complaints Details</h2>
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
</div>
</body>
</html>
