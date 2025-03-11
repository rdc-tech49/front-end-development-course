<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
<?php
  include "header.php";
  ?>


<section id="contact">
    <div class="content">
      <h2>Contact Us</h2>
      <p>If you have any questions or would like to get in touch, feel free to contact us via the form below or reach us directly at <strong>contact@ourwebsite.com</strong>.</p>
      <form action="#" method="POST">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4" required></textarea><br><br>

        <input type="submit" value="Submit">
      </form>
    </div>
  </section>

  <?php
  include"footer.php";



  ?>



    
</body>
</html>