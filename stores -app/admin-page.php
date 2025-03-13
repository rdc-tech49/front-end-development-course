<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

// Dummy data (replace with actual values from the database)
$user_name = "Admin"; // Replace with $_SESSION['username']
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        .sidebar {
            width: 250px;
            background: #343a40;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100vh;
            position: fixed;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            padding: 10px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }
        .user-section {
            background: #212529;
            padding: 15px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .user-section:hover {
            background: #495057;
        }
        .user-name {
            font-size: 14px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div>
        <h4 class="text-center">Admin Panel</h4>
        <a href="dashboard.php">📊 Dashboard</a>
        <a href="inventory.php">📦 Inventory</a>
        <a href="supply_orders.php">📑 Supply Orders</a>
        <a href="purchase_orders.php">🛒 Purchase Orders</a>
    </div>

    <!-- User Section with Dropdown -->
    <div class="user-section" data-bs-toggle="modal" data-bs-target="#logoutModal">
        <div>
            <span class="user-name"><?php echo $_SESSION['user_name'] ."-". $_SESSION['role']; ?></span><br>
        </div>
        <button class="btn btn-primary ms-auto">Logout</button>
      </div>
</div>

<!-- Main Content -->
<div class="content">
    <h2>Welcome to Admin Dashboard</h2>
    <p>Manage inventory, supply orders, and purchase orders efficiently.</p>
</div>

<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to logout?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
