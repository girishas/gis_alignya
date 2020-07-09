<?php 
use PHPMailer\PHPMailer\PHPMailer;

require 'Phpmailer/Phpmailer/vendor/autoload.php';


// $mail->SMTPDebug = SMTP::DEBUG_SERVER;  
$mail = new PHPMailer();                    // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.office365.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'support@alignya.com';                     // SMTP username
    $mail->Password   = 'Loz95153';                               // SMTP password
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('support@alignya.com', 'Mailer');
    $mail->addAddress('dev.girishas@gmail.com', 'Joe User');     // Add a recipient
   // $mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('dev.girishas@gmail.com', 'Information');
   
    // Attachments
    
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();
 echo "<pre>";print_r($mail);die;
?>