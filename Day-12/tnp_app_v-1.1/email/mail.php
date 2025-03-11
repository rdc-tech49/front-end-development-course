<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include files for PHPMailer and SMTP protocol  
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Initialize PHP Mailer
$mail = new PHPMailer(true);                              // Passing 'true' enables exceptions
try {
    // Set SMTP as mailing protocol
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Mailer = "smtp";

    // Set required parameters for making an SMTP connection
    $mail->SMTPDebug = 1;                                 // Enable verbose debug output
    $mail->SMTPAuth = TRUE;                               // Enable SMTP authentication
    $mail->SMTPSecure = "tls";                            // Enable TLS encryption, 'ssl' (a predecessor to TSL) is also accepted
    $mail->Port = 587;                                    // TCP port to connect to (587 is a standard port for SMTP)
    $mail->Host = "smtp.gmail.com";                       // Specify main and backup SMTP servers
    $mail->Username = "test.harishankar@gmail.com";              // SMTP username
    $mail->Password = "ffly xvnb qyht qenh";                     // SMTP password

    // Specify recipients
    $mail->setFrom('test.harishankar@gmail.com', 'TN-Police Tech-Wings');      
    $mail->addAddress('harishankar@nielitchennai.edu.in', 'name-is-optional');
    // $mail->addAddress('another-to-email@virginia.edu';  )
    //$mail->addReplyTo('reply-to-email@virginia.edu', 'name-is-optional');
    //ail->addCC('');
    //ail->addBCC('');

    // Specify email content
    $mail->isHTML(true);                        // Set email format to HTML
    //$mail->Subject = 'Test to email service';
    //$mail->Body    = 'hi this is test mail for using to SMTP protocal'; 

    // Send email
    //$mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
?>