<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Muhamad Nauval Azhar">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="This is a login page template based on Bootstrap 5">
	<title>Forgot Password Page - RDC-Tech</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
	<section class="vh-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9 my-auto"> 
					<div class="card shadow-lg">
						<div class="card-body p-5">							
							<h1 class="fs-4 card-title fw-bold mb-4 text-center">Forgot Password</h1>
                            <?php
        if(isset($_SESSION['message'])){
            echo '<div class="alert alert-info">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>
							<form method="POST" class="needs-validation" novalidate="" autocomplete="off" action="forgot_process.php">
								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
									<div class="invalid-feedback">
										Email is invalid
									</div>
								</div>
                                <div class="mb-3">
									<label class="mb-2 text-muted" for="dob">Date of Birth</label>
									<input id="dob" type="date" class="form-control" name="dob" required>
								    <div class="invalid-feedback">
								    	Date of Birth is required
							    	</div>
								</div>
                                <div class="d-flex align-items-center">
									<button type="submit" class="btn btn-primary ms-auto">
										Submit
									</button>
								</div>								
							</form>
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

</body>
</html>
