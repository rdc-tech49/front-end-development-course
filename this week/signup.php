<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Muhamad Nauval Azhar">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="This is a signup  page template based on Bootstrap 5">
	<title>Sign in Page</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
	<section class="vh-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9 mt-5 my-auto">
					
					<div class="card shadow-lg">
						<div class="card-body p-5 pb-2">							
							<?php 
							if (isset($_GET["signup_status"])) {  // Check if 'signup_status' exists in the URL
								$response_msg = $_GET["signup_status"];
								echo '<div id= "dangerMessage" class="alert alert-danger text-center">';
								echo $response_msg;
								echo '</div>';
							}
							?>
							<h1 class="fs-4 card-title fw-bold mb-4 text-center">SIGN UP</h1>
							<form method="POST" class="needs-validation" novalidate="" autocomplete="off" action="signup_process.php">
								<div class="mb-3 ">
									<label class="mb-2 text-muted" for="name">Name</label>
									<input id="name" type="text" class="form-control" name="name" value="" required autofocus>
									<div class="invalid-feedback">
										Name is required	
									</div>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" value="" required>
									<div class="invalid-feedback">
										Email is invalid
									</div>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="password">Password</label>
									<input id="password" type="password" class="form-control" name="password" required>
								    <div class="invalid-feedback">
								    	Password is required
							    	</div>
								</div>
								<div class="mb-3">
									<label class="mb-2 text-muted" for="dob">Date of Birth</label>
									<input id="dob" type="date" class="form-control" name="dob" required>
								    <div class="invalid-feedback">
								    	Date of Birth is required
							    	</div>
								</div>
								<div class="mb-3">
									<label for="gender" class="mb-2 text-muted">Gender</label>
									<select class="form-control" name="gender" required>
										<option value="">Select Gender</option>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
										<option value="Other">Other</option>
									</select>
									<div class="invalid-feedback">Gender is required</div>
								</div>

								<div class="mb-3">
									<label for="designation" class="mb-2 text-muted">Designation</label>
									<select class="form-control" name="designation" required>
										<option value="">Select Designation</option>
										<option value="Inspector">Inspector (Technical)</option>
										<option value="Sub-Inspector">Sub-Inspector (Technical)</option>
									</select>
									<div class="invalid-feedback">Designation is required</div>
								</div>

								<p class="form-text text-muted mb-3">
									By registering you agree with our terms and condition.
								</p>

								<div class="align-items-center d-flex">
									<button type="submit" class="btn btn-primary ms-auto">
										Register	
									</button>
								</div>
							</form>								
						</div>
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								Already have an account? <a href="login.php" class="text-dark">Login</a>
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
            var messageDiv = document.getElementById("dangerMessage");
            if (messageDiv) {
                messageDiv.style.display = "none";
            }
        }, 10000);
    </script>
</body>
</html>
