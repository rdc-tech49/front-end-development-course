<?php

include 'database_config.php'; // Your DB connection

// Fetch inventory data
$query = "SELECT id, item_name, item_model, item_quantity, purchased_date FROM stock_received ORDER BY id DESC";
$result = $conn->query($query);

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_name = $_POST['item_name'];
    $item_model = $_POST['item_model'];
    $item_quantity = $_POST['item_quantity'];
    $item_description = $_POST['item_description'];
    $purchased_date = $_POST['purchased_date'];
    $purchase_order_number = $_POST['purchase_order_number'];
    $vendor_details = $_POST['vendor_details'];
    $warranty_expiry_date = $_POST['warranty_expiry_date'];

    $insertQuery = "INSERT INTO stock_received (item_name, item_model, item_quantity, item_description, purchased_date, purchase_order_number, vendor_details, warranty_expiry_date)
                    VALUES ('$item_name', '$item_model', '$item_quantity', '$item_description', '$purchased_date', '$purchase_order_number', '$vendor_details', '$warranty_expiry_date')";

    if ($conn->query($insertQuery)) {
        header("Location: inventory.php?success=Stock added successfully");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        
        .form-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
          </style>
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="content" style="margin-left: 250px; padding: 20px;overflow-y: auto;  background-color: #f8f9fa;">
    <h2>Inventory Management</h2>

    <!-- Bootstrap Tabs -->
    <ul class="nav nav-tabs mt-3" id="inventoryTabs" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" id="inventory-tab" data-bs-toggle="tab" data-bs-target="#inventory" type="button" role="tab">📦 Inventory</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="add-stock-tab" data-bs-toggle="tab" data-bs-target="#add-stock" type="button" role="tab">➕ Add Stock</button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content mt-3" id="inventoryTabsContent">

        <!-- Inventory Table -->
        <div class="tab-pane fade show active" id="inventory" role="tabpanel">
            <h3>Stock Inventory</h3>
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success"><?php echo $_GET['success']; ?></div>
            <?php endif; ?>

            <div class="table-responsive" style="max-height: 400px; overflow-y: scroll;">
            <input type="text" id="searchBox" class="form-control mb-3" placeholder="Search stocks...">

                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Serial Number</th>
                            <th>Item Name</th>
                            <th>Item Model</th>
                            <th>Item Quantity</th>
                            <th>Purchased Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="inventoryTable">
                    <?php
                    include 'database_config.php';
                    $query = "SELECT * FROM stock_received ORDER BY id DESC";
                    $result = $conn->query($query);
                    while ($row = $result->fetch_assoc()):
                    ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['item_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['item_model']); ?></td>
                            <td><?php echo htmlspecialchars($row['item_quantity']); ?></td>
                            <td><?php echo date("d M Y", strtotime($row['purchased_date'])); ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm editBtn" data-id="<?php echo $row['id']; ?>" data-bs-toggle="modal" data-bs-target="#editStockModal">Edit</button>

                                <button class="btn btn-danger btn-sm deleteBtn" data-id="<?php echo $row['id']; ?>">Delete</button>
                            </td>

                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
                        <!-- edit  -->
                         <!-- Edit Stock Modal -->
<div class="modal fade" id="editStockModal" tabindex="-1" aria-labelledby="editStockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStockModalLabel">Edit Stock</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editStockForm">
                    <input type="hidden" id="edit_stock_id">
                    
                    <div class="mb-3">
                        <label for="edit_item_name" class="form-label">Item Name</label>
                        <input type="text" class="form-control" id="edit_item_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_item_model" class="form-label">Item Model</label>
                        <input type="text" class="form-control" id="edit_item_model" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_item_quantity" class="form-label">Item Quantity</label>
                        <input type="number" class="form-control" id="edit_item_quantity" required>
                    </div>

                    <button type="button" class="btn btn-primary" id="updateStockBtn">Update Stock</button>
                </form>
            </div>
        </div>
    </div>
</div>

                        <!-- edit  -->
        <!-- Add Stock Form -->
        <div class="tab-pane fade" id="add-stock" role="tabpanel">
            <h3>Add Stock</h3>
            <div class="form-box mt-3">
            <form method="POST" class="mt-3">
                <div class="mb-3">
                    <label for="item_name" class="form-label">Item Name</label>
                    <input type="text" class="form-control" name="item_name" required>
                </div>
                <div class="mb-3">
                    <label for="item_model" class="form-label">Item Model</label>
                    <input type="text" class="form-control" name="item_model" required>
                </div>
                <div class="mb-3">
                    <label for="item_quantity" class="form-label">Item Quantity</label>
                    <input type="number" class="form-control" name="item_quantity" required>
                </div>
                <div class="mb-3">
                    <label for="item_description" class="form-label">Item Description</label>
                    <textarea class="form-control" name="item_description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="purchased_date" class="form-label">Purchased Date</label>
                    <input type="date" class="form-control" name="purchased_date" required>
                </div>
                <div class="mb-3">
                    <label for="purchase_order_number" class="form-label">Purchase Order Number</label>
                    <input type="text" class="form-control" name="purchase_order_number">
                </div>
                <div class="mb-3">
                    <label for="vendor_details" class="form-label">Vendor Details</label>
                    <input type="text" class="form-control" name="vendor_details">
                </div>
                <div class="mb-3">
                    <label for="warranty_expiry_date" class="form-label">Warranty Expiry Date</label>
                    <input type="date" class="form-control" name="warranty_expiry_date">
                </div>
                <button type="submit" class="btn btn-primary">Add Stock</button>
            </form>
            </div>
        </div>

    </div>
</div>
<script>
    document.getElementById("searchBox").addEventListener("keyup", function () {
    let value = this.value.toLowerCase();
    document.querySelectorAll("#inventoryTable tr").forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(value) ? "" : "none";
    });
});


    document.addEventListener("DOMContentLoaded", function () {

        document.querySelectorAll(".deleteBtn").forEach(button => {
    button.addEventListener("click", function () {
        if (confirm("Are you sure you want to delete this stock?")) {
            let stockId = this.getAttribute("data-id");

            fetch("stock_actions.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `action=delete&id=${stockId}`
            }).then(response => response.text()).then(data => {
                alert(data);
                location.reload();
            });
        }
    });
});

    // Handle Edit Button Click
    document.querySelectorAll(".editBtn").forEach(button => {
    button.addEventListener("click", function () {
        let stockId = this.getAttribute("data-id");
        fetch("stock_actions.php?id=" + stockId)
            .then(response => response.json())
            .then(data => {
                document.getElementById("edit_stock_id").value = data.id;
                document.getElementById("edit_item_name").value = data.item_name;
                document.getElementById("edit_item_model").value = data.item_model;
                document.getElementById("edit_item_quantity").value = data.item_quantity;
            });
    });
});


    // Update Stock
    document.getElementById("updateStockBtn").addEventListener("click", function () {
    let stockId = document.getElementById("edit_stock_id").value;
    let itemName = document.getElementById("edit_item_name").value;
    let itemModel = document.getElementById("edit_item_model").value;
    let itemQuantity = document.getElementById("edit_item_quantity").value;

    fetch("stock_actions.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `action=update&id=${stockId}&item_name=${itemName}&item_model=${itemModel}&item_quantity=${itemQuantity}`
    }).then(response => response.text()).then(data => {
        alert(data);
        location.reload();
    });
});

});

</script>
</body>
</html>
