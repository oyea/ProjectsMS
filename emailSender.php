<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mailer/src/Exception.php';
require 'mailer/src/PHPMailer.php';
require 'mailer/src/SMTP.php';

function sendEmail($to, $subject, $message)
{
    $mail = new PHPMailer(true); // Passing `true` enables exceptions

    try {
        // Server settings
        $mail->SMTPDebug = 0; // Disable debugging
        $mail->isSMTP(); // Send using SMTP
        $mail->Host       = 'smtp.example.com'; // SMTP server
        $mail->SMTPAuth   = true; // Enable SMTP authentication
        $mail->Username   = 'your_email@example.com'; // SMTP username
        $mail->Password   = 'your_email_password'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port       = 587; // TCP port to connect to

        // Recipients
        $mail->setFrom('your_email@example.com', 'PIMS PM');

        // Set the recipient or recipients $to can be array or recipients like $to=[user1@pims.com,user2@pism.com...etc]
        if (is_array($to)) {
            foreach ($to as $recipient) {
                $mail->addAddress($recipient);
            }
        } else {
            $mail->addAddress($to);
        }

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
