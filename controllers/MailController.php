<?php

include_once '../includes/db.php';
include_once '../models/mail.php';

Class MailController{

    private $mail;

    public function __construct(){
        $this->mail = new Mail();
    }

    public function registerMail($name, $email){
      $this->mail->sendRegistrationEmail($name,$email);
    }

    public function passwordChangeMail($name,$email){
        $this->mail->sendPasswordChangeEmail($name,$email);
    }

    public function emailChangeMail($name,$old_email,$new_email){
        $this->mail->sendEmailChangeMail($name,$old_email,$new_email);
    }

}