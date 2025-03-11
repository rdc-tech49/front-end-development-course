<?php
session_start();
include 'database_config.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: user_dashboard.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: admin.php?error=Missing customer id");
    exit();
}

$customer_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $stmt = $conn->prepare("UPDATE customer_info SET name=?, email=?, role=? WHERE user_id=?");
    $stmt->bind_param("sssi", $name, $email, $role, $customer_id);
    if ($stmt->execute()) {
        header("Location: admin.php?message=Customer updated successfully");
        exit();
    } else {
        echo "Error updating customer: " . $conn->error;
    }
} else {
    $stmt = $conn->prepare("SELECT name, email, role FROM customer_info WHERE user_id=?");
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        echo "Customer not found";
        exit();
    }
    $customer = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Customer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Customer</h2>
    <form method="post" action="">
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($customer['name']); ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($customer['email']); ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role:</label>
            <select name="role" id="role" class="form-control" required>
                <option value="user" <?php if($customer['role'] == 'user') echo 'selected'; ?>>User</option>
                <option value="admin" <?php if($customer['role'] == 'admin') echo 'selected'; ?>>Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Customer</button>
        <a href="admin.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
