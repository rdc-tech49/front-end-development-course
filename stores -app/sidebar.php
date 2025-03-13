<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}
?>

<div class="sidebar">
    
    <h4 class="text-center text-white py-3">Admin Panel</h4>
    <a href="dashboard.php">📊 Dashboard</a>
    <a href="inventory.php">📦 Inventory</a>
    <a href="supply_orders.php">📑 Supply Orders</a>
    <a href="purchase_orders.php">🛒 Purchase Orders</a>

    <!-- User Info & Logout -->
    <div class="user-section" data-bs-toggle="modal" data-bs-target="#logoutModal">
        <div>
        <span class="user-name"><?php echo $_SESSION['user_name'] ."-". $_SESSION['role']; ?></span><br>
        </div>
        <button class="btn btn-primary ms-auto">Logout</button>        
    </div>
    
</div>

<!-- Logout Modal -->
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

<style>
    
       
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #343a40;
            color: white;
            display: flex;
            flex-direction: column;
            
            
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
        
        .topdiv{
            display: flex;
            justify-content: space-between;
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
</style>
