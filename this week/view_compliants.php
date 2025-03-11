<?php
session_start();
include 'database_config.php'; // Database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?error=Please log in first.");
    exit();
}

$user_id = $_SESSION['user_id']; // Get logged-in user's ID

// Pagination setup
$limit = 10; // Complaints per page
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

// Sorting
$sort_column = isset($_GET['sort']) ? $_GET['sort'] : 'complaint_date';
$sort_order = (isset($_GET['order']) && $_GET['order'] == 'asc') ? 'ASC' : 'DESC';
$next_order = ($sort_order == 'ASC') ? 'desc' : 'asc';

// Search filter
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// SQL query with search, sorting, and pagination
$sql = "SELECT complaint_number, complaint_title, mobile_number, address, complaint_message, file_upload, complaint_date, respond_msg, respond_date, respond_status 
        FROM user_complaints 
        WHERE user_id = ? AND 
              (complaint_number LIKE ? OR complaint_title LIKE ? OR respond_status LIKE ?)
        ORDER BY $sort_column $sort_order
        LIMIT ?, ?";

$stmt = $conn->prepare($sql);
$searchTerm = "%$search%";
$stmt->bind_param("isssii", $user_id, $searchTerm, $searchTerm, $searchTerm, $offset, $limit);
$stmt->execute();
$result = $stmt->get_result();

// Get total number of complaints for pagination
$count_sql = "SELECT COUNT(*) AS total FROM user_complaints 
              WHERE user_id = ? AND 
                    (complaint_number LIKE ? OR complaint_title LIKE ? OR respond_status LIKE ?)";
$count_stmt = $conn->prepare($count_sql);
$count_stmt->bind_param("isss", $user_id, $searchTerm, $searchTerm, $searchTerm);
$count_stmt->execute();
$count_result = $count_stmt->get_result();
$total_complaints = $count_result->fetch_assoc()['total'];

$total_pages = ceil($total_complaints / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Complaints</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">

    <h2 class="mb-4">My Complaints</h2>

    <!-- Search Form -->
    <form method="GET" action="" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search complaints..." value="<?= htmlspecialchars($search) ?>">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <!-- Export Buttons -->
    <a href="export_complaints.php?format=pdf" class="btn btn-danger mb-3">Export as PDF</a>
    <a href="export_complaints.php?format=csv" class="btn btn-success mb-3">Export as Excel</a>



    <?php if ($result->num_rows > 0): ?>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th><a href="?search=<?= urlencode($search) ?>&sort=complaint_number&order=<?= $next_order ?>">Complaint No</a></th>
                    <th><a href="?search=<?= urlencode($search) ?>&sort=complaint_title&order=<?= $next_order ?>">Title</a></th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Message</th>
                    <th>File</th>
                    <th><a href="?search=<?= urlencode($search) ?>&sort=complaint_date&order=<?= $next_order ?>">Date</a></th>
                    <th>Response</th>
                    <th><a href="?search=<?= urlencode($search) ?>&sort=respond_status&order=<?= $next_order ?>">Status</a></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['complaint_number']) ?></td>
                        <td><?= htmlspecialchars($row['complaint_title']) ?></td>
                        <td><?= htmlspecialchars($row['mobile_number']) ?></td>
                        <td><?= htmlspecialchars($row['address']) ?></td>
                        <td><?= htmlspecialchars($row['complaint_message']) ?></td>
                        <td>
                            <?php if (!empty($row['file_upload'])): ?>
                                <a href="<?= htmlspecialchars($row['file_upload']) ?>" target="_blank">View File</a>
                            <?php else: ?>
                                No File
                            <?php endif; ?>
                        </td>
                        <td><?= date("d M Y, h:i A", strtotime($row['complaint_date'])) ?></td>
                        <td><?= !empty($row['respond_msg']) ? htmlspecialchars($row['respond_msg']) : 'Pending' ?></td>
                        <td>
                            <span class="badge <?= ($row['respond_status'] == 'Resolved') ? 'bg-success' : 'bg-warning' ?>">
                                <?= htmlspecialchars($row['respond_status'] ?: 'Pending') ?>
                            </span>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <nav>
            <ul class="pagination">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?search=<?= urlencode($search) ?>&sort=<?= $sort_column ?>&order=<?= $sort_order ?>&page=<?= $page - 1 ?>">Previous</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="?search=<?= urlencode($search) ?>&sort=<?= $sort_column ?>&order=<?= $sort_order ?>&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?search=<?= urlencode($search) ?>&sort=<?= $sort_column ?>&order=<?= $sort_order ?>&page=<?= $page + 1 ?>">Next</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

    <?php else: ?>
        <div class="alert alert-warning">No complaints found.</div>
    <?php endif; ?>

</body>
</html>

<?php
$stmt->close();
$count_stmt->close();
$conn->close();
?>
