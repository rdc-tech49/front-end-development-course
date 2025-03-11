<!-- filepath: c:\xampp\htdocs\police_training\police_training\user_dashboard.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard - TN-Police</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./css/index.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      padding-top: 100px; /* Adjust this value based on the height of your header */
    }
  </style>



</head>
<body>

<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
include 'header.php';
include 'config.php';
?>


<br><br>
<!-- container -->
<div class="container-fluid">
  <div class="row">
      <div class="col-12">


    <?php 

// SQL query to fetch all records from the `user_complients` table
$sql = "SELECT * FROM user_complients WHERE user_id = " . $_SESSION['user_id'];
$result = $conn->query($sql);

// Check if there are any records
if ($result->num_rows > 0) {
    // Start the table structure
    echo "<table  class='table table-bordered table-hover' border='1'>
              <thead>
            <tr>
                <th>ID</th>
                <th>Compliant Number</th>
                <th>Complaint Title</th>
                <th>Mobile Number</th>
                <th>Address</th>
                <th>Complaint Message</th>
                <th>File Upload</th>
                <th>Compliant Date</th>
                <th>Respond Message</th>
                <th>Respond Date</th>
                <th>Respond Status</th>
            </tr>
              </thead>
              ";
   
    // Output data of each row
    $i=1;
    while($row = $result->fetch_assoc()) {
     
        echo "
        <tbody>
        <tr>
                <td>" . $i . "</td>
           
                <td>" . $row["compliant_number"] . "</td>
                <td>" . $row["complaint_title"] . "</td>
                <td>" . $row["mobile_number"] . "</td>
                <td>" . $row["address"] . "</td>
                <td>" . $row["complaint_message"] . "</td>
                <td>" . $row["file_upload"] . "</td>
                <td>" . $row["compliant_date"] . "</td>
                <td>" . $row["respond_msg"] . "</td>
                <td>" . $row["respond_date"] . "</td>
                <td>" . $row["respond_status"] . "</td>
              </tr>
              </tbody>";

              $i++;
    }

    // Close the table
    echo "</table>";
} else {
    echo "0 results found.";
}

// Close connection
$conn->close();

?>
   
       </div>
    </div>
</div>


<div style="margin-top: 20%;">
    
<?php
  include 'footer.php';
  ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function() {
    // Hide the element with id 'login_btn'
    $('#login_btn').hide();
    $('#signup_btn').hide();
    
});
  </script>

</body>

</html>