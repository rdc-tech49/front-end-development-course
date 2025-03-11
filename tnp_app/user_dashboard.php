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

<!-- <div class="container mt-5">
  <h2 class="text-center mb-4">User Dashboard</h2>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <form action="process_complaint.php" method="POST" class="p-4 shadow">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" value="<?php echo $_SESSION['username']; ?>" readonly>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email']; ?>" readonly>
        </div>
        <div class="mb-3">
          <label for="complaint" class="form-label">Complaint</label>
          <textarea class="form-control" id="complaint" name="complaint" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-lg w-100">Submit Complaint</button>
      </form>
    </div>
  </div>
</div> -->
<br>
<br>

<div class="container" style= "height :300px">

    <div class="card align-items-center m-2 d-inline-block" style="width: 18rem;">
    <a href="new_compliant.php" class="btn btn-primary  w-100">
       <i class="bi bi-file-earmark-plus-fill" style="font-size: 4rem; "></i>
       <br>
        <!-- <div class="card-body"> -->
             New Complien
    </a>
       <!-- </div> -->
    </div>

    <div class="card align-items-center m-2 d-inline-block" style="width: 18rem;">
    <a href="#" class="btn btn-primary  w-100">
       <i class="bi bi-eye" style="font-size: 4rem; "></i>
       <br>
       <!-- <div class="card-body"> -->
        View Complient
    </a>
      <!-- </div> -->
    </div>



   
    
   
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