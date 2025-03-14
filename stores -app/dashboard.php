<?php
include 'database_config.php'; // Include database connection
// Fetch consolidated stock data
$query = "
    SELECT sr.id, sr.item_name, sr.item_model, 
           sr.item_quantity AS quantity_received, 
           COALESCE(SUM(isup.quantity), 0) AS quantity_supplied, 
           itbs.quantity AS quantity_in_stock
    FROM stock_received sr
    LEFT JOIN item_supplied isup ON sr.item_name = isup.item_name AND sr.item_model = isup.item_model
    LEFT JOIN items_to_be_supplied itbs ON sr.item_name = itbs.item_name AND sr.item_model = itbs.item_model
    GROUP BY sr.id, sr.item_name, sr.item_model, sr.item_quantity, itbs.quantity
";
$result = $conn->query($query);

$query1 = "SELECT * FROM item_supplied";
 $result1 = $conn->query($query1);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<?php include "sidebar.php"; ?> <!-- Sidebar Navigation -->

<div class="container mt-4" style="margin-left: 250px; padding: 20px;"> 
    <h2 class="mb-4">Admin Dashboard</h2>

    <!-- Bootstrap Tabs -->
    <ul class="nav nav-tabs" id="dashboardTabs">
        <li class="nav-item">
            <a class="nav-link active" id="stocks-tab" data-bs-toggle="tab" href="#stocks">Stocks</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders">Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="reports-tab" data-bs-toggle="tab" href="#reports">Reports</a>
        </li>
    </ul>

    <div class="tab-content mt-3">
        <!-- Stocks Tab -->
        <div class="tab-pane fade show active" id="stocks">
        <div class="container mt-4">
            <h2>Stock Overview</h2>
            
            <!-- Search Filter -->
            <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search stock...">
            
            <!-- Export Buttons -->
            <div class="mb-3">
                <button id="exportCsv" class="btn btn-success">Export CSV</button>
                <a href="export_stock_pdf.php" class="btn btn-danger mb-3">Export to PDF</a>
            </div>

            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-bordered table-striped" id="stockTable">
                    <thead class="table-dark">
                        <tr>
                            <th>Serial No</th>
                            <th>Item Name</th>
                            <th>Item Model</th>
                            <th>Quantity Received</th>
                            <th>Quantity Supplied</th>
                            <th>Quantity in Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr class="<?= ($row['quantity_in_stock'] == 0) ? 'table-success text-decoration-line-through' : (($row['quantity_in_stock'] < 5) ? 'table-danger' : '') ?>">
                                <td><?= $row['id']; ?></td>
                                <td><?= htmlspecialchars($row['item_name']); ?></td>
                                <td><?= htmlspecialchars($row['item_model']); ?></td>
                                <td><?= $row['quantity_received']; ?></td>
                                <td><?= $row['quantity_supplied']; ?></td>
                                <td><?= $row['quantity_in_stock']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>

        <!-- Orders Tab (Empty for now) -->
        <div class="tab-pane fade" id="orders">
        <div class="container mt-4">
            <h2>Items Supplied</h2>
            
            <!-- Search Filter -->
            <input type="text" id="searchOrders" class="form-control mb-3" placeholder="Search ...">
            
            <!-- Export Buttons -->
            <div class="mb-3">
                <button id="exportCsv" class="btn btn-success">Export CSV</button>
                <a href="export_supplied_pdf.php" class="btn btn-danger mb-3">Export to PDF</a>
            </div>

            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-bordered table-striped supplied-table" >
                    <thead class="table-dark">
                        <tr>
                        <th>Serial No</th>
                        <th>Item Name</th>
                        <th>Item Model</th>
                        <th>Quantity Supplied</th>
                        <th>Supply Date</th>
                        <th>Supplied To</th>
                        <th>Received Person</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($row1 = $result1->fetch_assoc()):?> 
                        
                            <tr>

                            <td><?= $row1['id']; ?></td>
                                <td><?= $row1['item_name'] ?></td>
                                <td><?= $row1['item_model'] ?></td>
                                <td><?= $row1['quantity']; ?></td>
                                <td><?= $row1['supplied_date']; ?></td>
                                <td><?= $row1['supplied_to']; ?></td>
                                <td><?= $row1['received_person_name']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                                    
                        
                        
                    </tbody>
                </table>
            </div>
        </div>




        <!-- Reports Tab (Empty for now) -->
        <div class="tab-pane fade" id="reports">
            <h4>Reports</h4>
            <div class="row">
                <!-- Bar Chart: Quantity Received vs. Supplied -->
                <div class="col-md-6">
                    <canvas id="stockChart"></canvas>
                </div>
                
                <!-- Pie Chart: Stock Distribution -->
                <div class="col-md-6">
                    <canvas id="stockPieChart"></canvas>
                </div>
            </div>

            <div class="row mt-4">
                <!-- Line Chart: Supply Trends -->
                <div class="col-md-12">
                    <canvas id="supplyTrendChart"></canvas>
                </div>
            </div>

        </div>


        
    </div>
</div>

<!-- //for first tab  -->
<script>
    // Search Functionality
    document.getElementById("searchInput").addEventListener("keyup", function() {
        let searchTerm = this.value.toLowerCase();
        let rows = document.querySelectorAll("#stockTable tbody tr");

        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(searchTerm) ? "" : "none";
        });
    });

    // Export CSV
    document.getElementById("exportCsv").addEventListener("click", function() {
        let csv = [];
        let rows = document.querySelectorAll("#stockTable tr");

        for (let row of rows) {
            let cols = row.querySelectorAll("td, th");
            let rowData = [];
            cols.forEach(col => rowData.push(col.innerText));
            csv.push(rowData.join(","));
        }

        let csvFile = new Blob([csv.join("\n")], { type: "text/csv" });
        let link = document.createElement("a");
        link.href = URL.createObjectURL(csvFile);
        link.download = "stock_data.csv";
        link.click();
    });
</script>

<!-- for second tab  -->
 <script>
    // Search Functionality for Orders Table
document.getElementById("searchOrders").addEventListener("keyup", function() {
    let searchValue = this.value.toLowerCase();
    document.querySelectorAll(".supplied-table tbody tr").forEach(row => {
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchValue) ? "" : "none";
    });
});

// CSV Export Function
document.getElementById("exportCSV").addEventListener("click", function() {
    let table = document.querySelector(".supplied-table");
    let csv = [];
    for (let row of table.rows) {
        let cells = [...row.children].map(cell => `"${cell.innerText}"`);
        csv.push(cells.join(","));
    }
    let csvContent = "data:text/csv;charset=utf-8," + csv.join("\n");
    let link = document.createElement("a");
    link.setAttribute("href", encodeURI(csvContent));
    link.setAttribute("download", "items_supplied.csv");
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
});

 </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<!-- for third tab  -->
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let reportTab = document.getElementById("reports-tab");
    let chartsInitialized = false;

    reportTab.addEventListener("click", function () {
        if (!chartsInitialized) {
            fetch('get_stock_data.php')
                .then(response => response.json())
                .then(data => {
                    if (!data || data.item_names.length === 0) {
                        console.error("No data received for charts.");
                        return;
                    }

                    // ✅ Ensure no negative stock values
                    data.quantity_in_stock = data.quantity_in_stock.map(qty => Math.max(0, qty));

                    renderCharts(data);
                    chartsInitialized = true;
                })
                .catch(error => console.error("Error fetching stock data:", error));
        }
    });
});

function renderCharts(data) {
    let ctxBar = document.getElementById('stockChart').getContext('2d');
    let ctxPie = document.getElementById('stockPieChart').getContext('2d');
    let ctxLine = document.getElementById('supplyTrendChart').getContext('2d');

    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: data.item_names,
            datasets: [
                { label: 'Quantity Received', data: data.quantity_received, backgroundColor: 'blue' },
                { label: 'Quantity Supplied', data: data.quantity_supplied, backgroundColor: 'red' }
            ]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: data.item_names,
            datasets: [{
                data: data.quantity_in_stock,
                backgroundColor: ['green', 'orange', 'purple', 'yellow', 'pink']
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: data.supply_dates,
            datasets: [{
                label: 'Items Supplied Over Time',
                data: data.supply_counts,
                borderColor: 'blue',
                fill: false
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });
}
</script>
</body>
</html>
