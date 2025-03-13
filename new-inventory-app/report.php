<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "inventory_db");
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT COUNT(*) as total_items, SUM(quantity) as total_quantity, SUM(quantity*price) as total_value, AVG(price) as avg_price FROM items";
$result = $conn->query($sql);
$report = $result->fetch_assoc();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reports - Inventory Management</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>Inventory Reports</h1>
    <nav>
      <ul>
        <li><a href="index.php">Dashboard</a></li>
        <li><a href="view_items.php">View Items</a></li>
        <li><a href="logout.php">Logout (<?php echo $_SESSION['username']; ?>)</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <section class="report">
      <h2>Inventory Summary</h2>
      <ul>
        <li>Total Products: <?php echo $report['total_items']; ?></li>
        <li>Total Quantity: <?php echo $report['total_quantity']; ?></li>
        <li>Total Stock Value: $<?php echo number_format($report['total_value'],2); ?></li>
        <li>Average Price: $<?php echo number_format($report['avg_price'],2); ?></li>
      </ul>
    </section>
  </main>
  <footer>
    <p>&copy; 2025 Inventory Management System</p>
  </footer>
</body>
</html>
