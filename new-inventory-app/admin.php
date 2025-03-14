<?php
session_start();
$conn = new mysqli("localhost", "root", "", "inventory_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if admin is logged in (Replace with your session authentication)
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: login.html");
    exit();
}

// Fetch users
$result = $conn->query("SELECT id, username, email, role FROM users");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - User Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>User Management</h2>
    <table border="1">
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($row["username"]) ?></td>
                <td><?= htmlspecialchars($row["email"]) ?></td>
                <td><?= htmlspecialchars($row["role"]) ?></td>
                <td>
                    <form action="update_role.php" method="POST">
                        <input type="hidden" name="user_id" value="<?= $row["id"] ?>">
                        <select name="new_role">
                            <option value="admin">Admin</option>
                            <option value="manager">Manager</option>
                            <option value="staff">Staff</option>
                        </select>
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
<?php
$conn->close();
?>
