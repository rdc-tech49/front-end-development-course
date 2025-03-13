
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<?php include 'sidebar.php'; ?>

<!-- Main Content -->
<div class="content" style="margin-left: 250px; padding: 20px;">
    <h2>Dashboard</h2>

    <!-- Bootstrap Tabs -->
    <ul class="nav nav-tabs mt-3" id="dashboardTabs" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" id="stocks-tab" data-bs-toggle="tab" data-bs-target="#stocks" type="button" role="tab">📦 Stocks</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab">📑 Orders</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="reports-tab" data-bs-toggle="tab" data-bs-target="#reports" type="button" role="tab">📊 Reports</button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content mt-3" id="dashboardTabsContent">
        <div class="tab-pane fade show active" id="stocks" role="tabpanel">
            <h3>Stocks</h3>
            <p>Stock-related data will be displayed here.</p>
        </div>
        <div class="tab-pane fade" id="orders" role="tabpanel">
            <h3>Orders</h3>
            <p>Order details will be displayed here.</p>
        </div>
        <div class="tab-pane fade" id="reports" role="tabpanel">
            <h3>Reports</h3>
            <p>Reports and analytics will be shown here.</p>
        </div>
    </div>
</div>

</body>
</html>
