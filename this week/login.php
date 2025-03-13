<?php
session_start();
include "database_config.php"; // Database connection

// Check if "Remember Me" cookie exists
if (isset($_COOKIE["remember_me"])) {
    $token = $_COOKIE["remember_me"];

    // Verify the token from the database
    $stmt = $conn->prepare("SELECT user_id, email FROM customer_info WHERE remember_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['email'] = $user['email'];
        header("Location: user_dashboard.php"); // Redirect if already logged in
        exit();
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Muhamad Nauval Azhar">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="This is a login page template based on Bootstrap 5">
	<title>Login Page - RDC-Tech</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
<div class="loader"></div>
	<section class="vh-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9 my-auto"> 
					<div class="card shadow-lg">
						<div class="card-body p-5">

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
							
							<h1 class="fs-4 card-title fw-bold mb-4 text-center">LOGIN</h1>
							<form method="POST" class="needs-validation" novalidate="" autocomplete="" action="login_process.php">
								<!-- //for real projects make autocomplete "off" -->
								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
									<div class="invalid-feedback">
										Email is invalid
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
								<!-- Hidden fields for latitude and longitude -->
    <input type="hidden" id="latitude" name="latitude">
    <input type="hidden" id="longitude" name="longitude">


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
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								Don't have an account? <button type="submit" class="btn btn-info ms-3"><a href="signup.php" class="text-light text-decoration-none">Sign Up</a> </button>
							</div>
						</div>
					</div>
					<div class="text-center mt-5 text-muted">
						Copyright &copy; <span id="currentYear"></span> RDC. All rights reserved.
					</div>
				</div>
			</div>
		</div>
	</section>

	<script>
		document.getElementById('currentYear').textContent = new Date().getFullYear();
	</script>
	<script src="js/login.js"></script>
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
	


	<script>
document.addEventListener("DOMContentLoaded", function () {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            document.getElementById("latitude").value = position.coords.latitude;
            document.getElementById("longitude").value = position.coords.longitude;
        }, function (error) {
            console.error("Error getting location: ", error);
        });
    } else {
        console.error("Geolocation is not supported by this browser.");
    }
});
</script>
</body>
</html>
