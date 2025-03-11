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
//session_start();
// if (!isset($_SESSION['username'])) {
//     //header("Location: login.php");
//     exit();
// }
include "header.php";
?>

<br>
<br>

<div class="container mt-5 form-container">
    <!-- Form Title -->
    <h2 class="form-title text-center">Complaint Submission Form</h2>

    <!-- Complaint Form -->
    <form action="complaint_process.php" method="POST" enctype="multipart/form-data">
        
        <!-- Compliant Title -->
        <div class="form-group m-2">
            <label for="complaint_title">Compliant Title:</label>
            <input type="text" class="form-control" id="complaint_title" name="complaint_title" required>
        </div>

        <!-- Mobile Number -->
        <div class="form-group m-2">
            <label for="mobile_number">Mobile Number:</label>
            <input type="tel" class="form-control" id="mobile_number" name="mobile_number" required>
        </div>

        <!-- Address -->
        <div class="form-group m-2">
            <label for="address">Address:</label>
            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
        </div>

        <!-- Compliant Message -->
        <div class="form-group m-2">
            <label for="complaint_message">Compliant Message:</label>
            <textarea class="form-control" id="complaint_message" name="complaint_message" rows="4" required></textarea>
        </div>

        <!-- Upload File -->
        <div class="form-group m-2">
            <label for="file_upload">Upload File (PDF format, Maximum file size 10MB):</label>
            <input type="file" class="form-control-file" id="file_upload" name="file_upload">
        </div><br>

        <!-- Submit Button -->
        <div class="form-group m-2 ">
        <button type="submit" class="btn btn-primary w-100">Submit Complaint</button>
        </div>
    
    </form>
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
<?php
  include 'footer.php';
  ?>
</html>