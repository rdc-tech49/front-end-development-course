<!-- filepath: c:\xampp\htdocs\police_training\police_training\admin.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - TN-Police</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./css/index.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    body {
      padding-top: 100px; /* Adjust this value based on the height of your header */
    }
  </style>
</head>
<body>

<?php
// session_start();
// $_SESSION['isAdmin'] = true; // Set this variable when the admin logs in
include "header.php";
// include "db_connection.php";

$sql = "SELECT * FROM users";
// $result = mysqli_query($conn, $sql);
?>

<div class="container mt-5">
  <h2 class="text-center mb-4">Admin Dashboard</h2>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="d-flex justify-content-between mb-4">
        <button class="btn btn-primary" onclick="toggleUsersTable()">View All Registered Users</button>
        <!-- Placeholder for the second button -->
        <a href="#" class="btn btn-secondary">Second Button</a>
      </div>
      <div id="usersTable" style="display: none;">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Username</th>
              <th>Email</th>
              <th>Password</th>
              <th>Confirm Password</th>
              <th>Address</th>
              <th>Date of Birth</th>
              <th>Gender</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
              <tr>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['password']; ?></td>
                <td><?php echo $row['confirm_password']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo $row['dob']; ?></td>
                <td><?php echo $row['gender']; ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  function toggleUsersTable() {
    var table = document.getElementById('usersTable');
    if (table.style.display === 'none') {
      table.style.display = 'block';
    } else {
      table.style.display = 'none';
    }
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>