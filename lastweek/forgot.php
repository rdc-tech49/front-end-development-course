<?php
session_start();
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php'; // Load Composer dependencies
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$servername = "localhost";
$username = "root"; // Default MySQL user
$password = "chander"; // Default password (for XAMPP, WAMP)
$dbname = "customers";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $dob = $_POST['dob'];

    // Validate user input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format!");
    }

    // Check if the email and DOB match
    $stmt = $conn->prepare("SELECT id FROM customer_info WHERE email = ? AND date_of_birth = ?");
    $stmt->bind_param("ss", $email, $dob);
    $stmt->execute();
    $stmt->store_result();


if ($stmt->num_rows > 0) {
    // Generate a unique reset token
    $token = bin2hex(random_bytes(50)); // Secure random token
    $expires = date("Y-m-d H:i:s", strtotime("+12 hour")); // 1-hour expiration

    // Store token in the database
    $stmt->bind_result($userId);
    $stmt->fetch();
    $updateStmt = $conn->prepare("UPDATE customer_info SET reset_token = ?, token_expiry = ? WHERE id = ?");
    $updateStmt->bind_param("ssi", $token, $expires, $userId);
    $updateStmt->execute();


    // Create reset link
    $resetLink = "localhost/reset_password.html?token=" . urlencode($token);


    // Send email with reset link
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'rdctech94@gmail.com'; // Secure email credentials
        $mail->Password = 'ezrc tqxn wkha dnxb';
        
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('rdctech94@gmail.com', 'Support Team');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Password Reset';
        $mail->Body = "Click the link below to reset your password:<br><a href='$resetLink'>$resetLink</a>";

        $mail->send();
        
        // echo "Password reset link has been sent to your email!";
        $_SESSION['message'] = "Reset link sent to your email!";
    } catch (Exception $e) {
        // echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        $_SESSION['message'] = "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    // echo "Invalid email or date of birth!";
    $_SESSION['message'] = "Invalid email or date of birth!";
}
// $stmt->close();
// $conn->close();
// Redirect using JavaScript
echo "<script>window.location.href = 'forgot.html';</script>";
exit();

}
?>


