<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET['id'])){
    header("Location: view_items.php");
    exit();
}

$item_id = $_GET['id'];

$conn = new mysqli("localhost", "root", "", "inventory_db");
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM items WHERE id = ?");
$stmt->bind_param("i", $item_id);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows != 1){
    echo "Item not found";
    exit();
}
$item = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Item - Inventory Management</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>Edit Item</h1>
    <nav>
      <ul>
        <li><a href="index.php">Dashboard</a></li>
        <li><a href="view_items.php">View Items</a></li>
        <li><a href="logout.php">Logout (<?php echo $_SESSION['username']; ?>)</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <section class="edit-item">
      <h2>Edit Item Details</h2>
      <form action="edit_item_process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" value="<?php echo $item['product_name']; ?>" required>
  
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="<?php echo $item['quantity']; ?>" required>
  
        <label for="price">Price:</label>
        <input type="text" id="price" name="price" value="<?php echo $item['price']; ?>" required>
  
        <button type="submit">Update Item</button>
      </form>
    </section>
  </main>
  <footer>
    <p>&copy; 2025 Inventory Management System</p>
  </footer>
</body>
</html>
