<?php
session_start();
include 'database_config.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: user_dashboard.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: admin.php?error=Missing complaint id");
    exit();
}

$complaint_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $complaint_title = $_POST['complaint_title'];
    $respond_status = $_POST['respond_status'];
    $respond_msg = $_POST['respond_msg'];

    $stmt = $conn->prepare("UPDATE user_complaints SET complaint_title=?, respond_status=?, respond_msg=? WHERE id=?");
    $stmt->bind_param("sssi", $complaint_title, $respond_status, $respond_msg, $complaint_id);
    if ($stmt->execute()) {
        header("Location: admin.php?message=Complaint updated successfully");
        exit();
    } else {
        echo "Error updating complaint: " . $conn->error;
    }
} else {
    $stmt = $conn->prepare("SELECT complaint_title, respond_status, respond_msg FROM user_complaints WHERE id=?");
    $stmt->bind_param("i", $complaint_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        echo "Complaint not found";
        exit();
    }
    $complaint = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Complaint</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Complaint</h2>
    <form method="post" action="">
        <div class="mb-3">
            <label for="complaint_title" class="form-label">Complaint Title:</label>
            <input type="text" name="complaint_title" id="complaint_title" value="<?php echo htmlspecialchars($complaint['complaint_title']); ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="respond_status" class="form-label">Respond Status:</label>
            <select name="respond_status" id="respond_status" class="form-control" required>
                <option value="Pending" <?php if($complaint['respond_status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                <option value="In Progress" <?php if($complaint['respond_status'] == 'In Progress') echo 'selected'; ?>>In Progress</option>
                <option value="Resolved" <?php if($complaint['respond_status'] == 'Resolved') echo 'selected'; ?>>Resolved</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="respond_msg" class="form-label">Response Message:</label>
            <textarea name="respond_msg" id="respond_msg" class="form-control"><?php echo htmlspecialchars($complaint['respond_msg']); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Complaint</button>
        <a href="admin.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
