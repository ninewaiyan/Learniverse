<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once '../vendor/Exception.php';
require_once  '../vendor/PHPMailer.php';
require_once '../vendor/SMTP.php';

Class Mail {
    private $mail;

    public function __construct(){
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port = 587;
    
        $this->mail->Username = 'learniverse.development@gmail.com'; // YOUR gmail email
        $this->mail->Password = 'cgjh xlpw ghqw frly'; // YOUR gmail password
    
        // Sender and recipient settings
        $this->mail->setFrom('learniverse.development@gmail.com', 'Learniverse');
    }

    // Method to send registration email
    public function sendRegistrationEmail($name , $email) {
        try {
            $this->mail->addAddress($email); // Add recipient
            $this->mail->isHTML(true);
            $this->mail->Subject = 'Welcome to Learniverse! Registration Successful';
            $this->mail->Body = "
                <p>Dear $name,</p>
                <p>We are thrilled to welcome you to <b>Learniverse</b>! Your registration was successful, and you are now part of a growing community of learners.</p>
                <h4>Here are your account details:</h4>
                <p><b>Name :</b>$name<br>
                <b>Email:</b> $email</p>
                <p>You can now log in to your account and start exploring all the learning tools and features available to you. To get started, visit the following link:</p>
                <a href='http://localhost/learniverse/users/login.php'>Login to Learniverse</a>
                <p>If you have any questions or need help, feel free to reach out to us at <b>learniverse.development@gmail.com</b>.</p>
                <p>Best regards,<br>The Learniverse Team</p>
            ";
            $this->mail->send();
            
        } catch (Exception $e) {
            echo 'Error: ' . $this->mail->ErrorInfo;
        }
    }


    // Method to send password change warning email
    public function sendPasswordChangeEmail($name, $email) {
        try {
            $this->mail->addAddress($email); // Add recipient
            $this->mail->isHTML(true);
            $this->mail->Subject = 'Important: Your Password Was Changed';
            $this->mail->Body = "
                <div style='color: #333;'>
                <p>Dear $name,</p>
                <p>This is a notification that your account password was recently changed.</p>
                <p>If you made this change, no further action is required. However, if you did not authorize this change, please reset your password immediately and contact our support team at <b>learniverse.development@gmail.com</b>.</p>
                <p>For security, we recommend regularly updating your password and avoiding using the same password across multiple sites.</p>
                <p>Best regards,<br>The Learniverse Team</p>
            </div>
            ";
            $this->mail->send();
            
        } catch (Exception $e) {
            echo 'Error: ' . $this->mail->ErrorInfo;
        }
    }

    public function sendEmailChangeMail($name, $old_email,$new_email) {
        try {
            $this->mail->addAddress($new_email); // Add recipient
            $this->mail->isHTML(true);
            $this->mail->Subject = 'Important: Your Email Address Has Been Changed';
            $this->mail->Body = "
                <p>Dear $name,</p>
                <p>This is to notify you that your account's email address has been changed from <b>$old_email</b> to <b>$new_email</b>.</p>
                <p>If you did not authorize this change, please contact our support team immediately at <b>learniverse.development@gmail.com</b>.</p>
                <p>If you made this change, no further action is required.</p>
                <p>Best regards,<br>The Learniverse Team</p>
            ";
            $this->mail->send();
            
        } catch (Exception $e) {
            echo 'Error: ' . $this->mail->ErrorInfo;
        }
    }
}








?>