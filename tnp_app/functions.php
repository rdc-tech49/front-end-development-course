<?php
include 'config.php';
include './email/mail.php';
  

   //var_dump($mail_object);

function registrationMailSend($to_address,$username){
    global $mail;

    echo "$to_address";
    echo "$username";
    $mail->addAddress($to_address, $username);
    $mail->isHTML(true);                        // Set email format to HTML
    $mail->Subject = "Registration confirmation email for TNP-Wings. ";
    $mail->Body    = "Dear <b>$username</b>, welcome to the Tamil Nadu Police Tech-Wings platform. Your registration has been successfully completed, and your registered email ID is <b>$to_address</b>. Stay safe and secure. Thank you for being a part of our community."; 
    // Send email
    $mail->send();

}


?>