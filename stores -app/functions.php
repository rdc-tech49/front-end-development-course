<?php
include 'database_config.php';
include './email/mail.php';
  

   //var_dump($mail_object);

function registrationMailSend($to_address,$username){
    global $mail;

    echo "$to_address";
    echo "$username";
    $mail->addAddress($to_address, $username);
    $mail->isHTML(true);                        // Set email format to HTML
    $mail->Subject = "Registration confirmation email for RDC - Tech Website. ";
    $mail->Body    = "Dear <b>$username</b>, welcome to the RDC - Tech platform. Your registration has been successfully completed, and your registered email ID is <b>$to_address</b>. Stay safe and secure. Thank you for being a part of our community."; 
    // Send email
    $mail->send();

}

function LoginMailSend($to_address,$username){
    global $mail;

    echo "$to_address";
    echo "$username";
    $mail->addAddress($to_address, $username);
    $mail->isHTML(true);                        // Set email format to HTML
    $mail->Subject = "Login to  - Tech Website. ";
    $mail->Body    = "Hi  <b>$username</b>, You have logged in to RDC Tech website from <b>$to_address</b>. If not  kindly contact admin. Thank you"; 
    // Send email
    $mail->send();
}

function ResetMailSend($to_address,$username,$reset_link){
    global $mail;

    echo "$to_address";
    echo "$username";
    $mail->addAddress($to_address, $username);
    $mail->isHTML(true);                        // Set email format to HTML
    $mail->Subject = "Password Reset Request";
    $mail->Body    = "Hello $username,\n\nWe received a request to reset your password. Please click the link below to reset your password:\n\n$reset_link\n\nIf you did not request a password reset, please ignore this email.\n\nRegards,\nRDC-Tech Team";
    // Send email
    $mail->send();
}

?>