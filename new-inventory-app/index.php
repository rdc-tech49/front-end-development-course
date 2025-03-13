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

// Latest 5 items
$sql = "SELECT * FROM items ORDER BY id DESC LIMIT 5";
$result = $conn->query($sql);

// Aggregated data
$sqlTotal = "SELECT SUM(quantity) AS total_quantity, SUM(quantity*price) AS total_value FROM items";
$totalResult = $conn->query($sqlTotal);
if($totalResult && $totalResult->num_rows > 0){
    $row = $totalResult->fetch_assoc();
    $totalItems = $row['total_quantity'];
    $totalStockValue = $row['total_value'];
} else {
    $totalItems = 0;
    $totalStockValue = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard - Inventory Management</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>Inventory Management</h1>
    <nav>
      <ul>
        <li><a href="index.php">Dashboard</a></li>
        <li><a href="add_item.php">Add Item</a></li>
        <li><a href="view_items.php">View Items</a></li>
        <li><a href="report.php">Reports</a></li>
        <li><a href="logout.php">Logout (<?php echo $_SESSION['username']; ?>)</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <section class="dashboard">
      <h2>Dashboard</h2>
      <div class="stats">
        <div class="stat-item">
          <h3>Total Items</h3>
          <p><?php echo $totalItems; ?></p>
        </div>
        <div class="stat-item">
          <h3>Total Stock Value</h3>
          <p>$<?php echo number_format($totalStockValue, 2); ?></p>
        </div>
      </div>
      <h2>Latest Inventory</h2>
      <table>
        <thead>
          <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if($result->num_rows > 0){
              while($row = $result->fetch_assoc()){
                  echo "<tr>
                          <td>".$row['product_name']."</td>
                          <td>".$row['quantity']."</td>
                          <td>$".number_format($row['price'],2)."</td>
                          <td>
                              <a href='edit_item.php?id=".$row['id']."'>Edit</a> | 
                              <a href='delete_item.php?id=".$row['id']."' onclick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a>
                          </td>
                        </tr>";
              }
          } else {
              echo "<tr><td colspan='4'>No items found</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </section>
  </main>
  <footer>
    <p>&copy; 2025 Inventory Management System</p>
  </footer>
</body>
</html>
<?php $conn->close(); ?>
