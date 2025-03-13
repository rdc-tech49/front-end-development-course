<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add New Item - Inventory Management</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>Add New Item</h1>
    <nav>
      <ul>
        <li><a href="index.php">Dashboard</a></li>
        <li><a href="view_items.php">View Items</a></li>
        <li><a href="report.php">Reports</a></li>
        <li><a href="logout.php">Logout (<?php echo $_SESSION['username']; ?>)</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <section class="add-item">
      <h2>Enter Item Details</h2>
      <form action="add_item_process.php" method="POST">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required>
  
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required>
  
        <label for="price">Price:</label>
        <input type="text" id="price" name="price" required>
  
        <button type="submit">Add Item</button>
      </form>
    </section>
  </main>
  <footer>
    <p>&copy; 2025 Inventory Management System</p>
  </footer>
</body>
</html>
