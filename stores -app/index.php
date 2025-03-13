<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="RDC">
    <meta name="generator" content="Hugo 0.122.0">
    <title>RDC Stores app</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
    <!-- Custom styles for this template -->
    <link href="styles/cover.css" rel="stylesheet">
  </head>

  <body>
  <div class="d-flex text-center text-bg-primary">
    <div class="container d-flex w-100 p-3 mx-auto flex-column">
      <header class="mb-1">
        <div>
          <h3 class="float-md-start mb-0">RDC</h3>
          <nav class="nav nav-masthead justify-content-center float-md-end">
            <a class="nav-link fw-bold py-1 px-0 active" aria-current="page" href="#">Home</a>
            <a class="nav-link fw-bold py-1 px-0"  href="#name">Login</a>
            <a class="nav-link fw-bold py-1 px-0" href="signup.php">Signup</a>
          </nav>
        </div>
      </header>
    </div>
    
    </div>
    <div class="container col-xl-10 col-xxl-8 px-4 py-1">
      <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
          <h1 class="display-4 fw-bold lh-1 mb-3 text-danger">INVENTORY MANAGEMENT APP</h1>
          <p class="col-lg-10 fs-4 text-secondary">Inventory tracking, real-time visibility into stock levels and movement, automates order management, customizable reports and analytics, empowering informed  decisions...</p>
        </div>
        <div class="col-md-10 mx-auto col-lg-5" id="login-form">

            <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary needs-validation" method="POST" novalidate="" autocomplete="" action="login_process.php">
              	<!-- alert for succesfull sign up  -->
							<?php 
								if (isset($_GET["signup_status"])) {  // Check if 'signup_status' exists in the URL
									$response_msg = htmlspecialchars($_GET["signup_status"], ENT_QUOTES, 'UTF-8');
									echo '<div id="successMessage" class="alert alert-success text-center">';
									echo $response_msg;
									echo '</div>';
								}
							?>

							<!-- alert for invalid login  -->
							<?php 
							if (isset($_GET["error"])) {  // Check if 'signup_status' exists in the URL
								$response_msg = htmlspecialchars($_GET["error"], ENT_QUOTES, 'UTF-8');
								echo '<div id="successMessage" class="alert alert-danger text-center">';
								echo $response_msg;
								echo '</div>';
							}
							?>
							<!-- alert for reset password  -->
							<?php 
								if (isset($_GET["reset_status"])) {  // Check if 'signup_status' exists in the URL
									$response_msg = htmlspecialchars($_GET["reset_status"], ENT_QUOTES, 'UTF-8');
									echo '<div id="successMessage" class="alert alert-success text-center">';
									echo $response_msg;
									echo '</div>';
								}
							?>
              <!-- //for real projects make autocomplete "off" -->
              <h1 class="fs-4 card-title fw-bold mb-4 text-center">LOGIN</h1>
              <div class="mb-3">
                <label class="mb-2 text-muted" for="name">User Name</label>
                <input id="name" type="text" class="form-control" name="name" value="" required autofocus>
                <div class="invalid-feedback">
                  User Name is invalid
                </div>
              </div>

              <div class="mb-3">
                <div class="mb-2 w-100">
                  <label class="text-muted" for="password">Password</label>
                  <a href="forgot.php" class="float-end">
                    Forgot Password?
                  </a>
                </div>
                <input id="password" type="password" class="form-control" name="password" required>
                  <div class="invalid-feedback">
                    Password is required
                  </div>
              </div>


              <div class="d-flex align-items-center">
                <div class="form-check">
                  <input type="checkbox" name="remember" id="remember" class="form-check-input">
                  <label for="remember" class="form-check-label">Remember Me</label>
                </div>
                <button type="submit" class="btn btn-primary ms-auto">
                  Login
                </button>
              </div>
            </form>

        </div>
      </div>
    </div>
  
    <div class="b-example-divider"></div>

    <script src="script/login.js"></script>
    <script>
        // Hide the message after 10 seconds
    setTimeout(function () {
    let messageDiv = document.getElementById("successMessage");
    if (messageDiv) {
			messageDiv.style.transition = "opacity 0.5s ease";
			messageDiv.style.opacity = "0";
			setTimeout(() => messageDiv.remove(), 500);
    }}, 5000);
    </script>
    </body>
</html>
