<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - TN-Police</title>
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
  include "header.php";
?>

<div class="container mt-5">
  <h2 class="text-center mb-4">Login</h2>
  <?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger text-center">
      <?php echo htmlspecialchars($_GET['error']); ?>
    </div>
  <?php endif; ?>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form action="login_process.php" method="POST" class="p-4 shadow">
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email1" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-lg w-100">Login</button>
      </form>

      <div class="mt-3 text-center">
      <?php
      $response_msg = $_GET["signup_status"];
      if(!empty($response_msg)){
      echo "<b style= 'color:green; '> $response_msg </b>";
      $_GET["signup_status"] = "";
      }
      ?>
      </div>
      
      <div class="mt-3 text-center">
        <p>Don't have an account? <a href="signup.php">Signup here</a></p>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function(){
    $("#login_btn").hide();
  })

//   $(document).ready(function() {
//     // Hide the element with id 'login_btn'
//     $('#login_btn').hide();
//     $('#signup_btn').hide();
    
// });
</script>
</body>
</html>