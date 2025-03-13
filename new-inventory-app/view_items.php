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

$searchQuery = "";
if(isset($_GET['search'])){
    $searchQuery = $_GET['search'];
    $stmt = $conn->prepare("SELECT * FROM items WHERE product_name LIKE ? ORDER BY id DESC");
    $searchParam = "%".$searchQuery."%";
    $stmt->bind_param("s", $searchParam);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT * FROM items ORDER BY id DESC";
    $result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>View Items - Inventory Management</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>Inventory Management</h1>
    <nav>
      <ul>
        <li><a href="index.php">Dashboard</a></li>
        <li><a href="add_item.php">Add Item</a></li>
        <li><a href="report.php">Reports</a></li>
        <li><a href="logout.php">Logout (<?php echo $_SESSION['username']; ?>)</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <section class="view-items">
      <h2>View Items</h2>
      <form method="GET" action="view_items.php">
        <input type="text" name="search" placeholder="Search by product name" value="<?php echo htmlspecialchars($searchQuery); ?>">
        <button type="submit">Search</button>
      </form>
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
