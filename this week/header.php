<?php
session_start();
$isuser = isset($_SESSION['email']) && !empty($_SESSION['email']);
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <img src="./images/p_logo.png" alt="Logo" width="80" height="80" class="d-inline-block align-text-top">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#services">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link contact-btn" href="contact.php">Contact</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        
        <?php if ($isuser): ?>
          <li class="nav-item me-5">
            <h4><?php echo htmlspecialchars($_SESSION['user_name']); ?></h4>
          </li>  
          <li class="nav-item">
            <a class="btn btn-danger" id="logout_btn" href="logout.php">Logout</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="btn btn-dark me-2" id="login_btn" href="login.php"  >Login</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-primary" id="signup_btn" href="signup.php"  >Signup</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
