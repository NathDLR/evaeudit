<?php

require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';
require 'vendor/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail{

    private $username;
    private $password;

    public function __construct(){
        $this->username = '';
        $this->password = '+';
    }

    /*public function sendNotif()
    {
        $name_from = 'EVE VEGAN®';
        $mail = new PHPMailer(true);
        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->CharSet = 'UTF-8';
        $mail->SMTPAuth = true; // enable SMTP authentication
        $mail->SMTPSecure = 'tls'; // sets the prefix to the servier
        $mail->Host = "smtp.ionos.fr"; // sets the SMTP server
        $mail->Port = 587; // set the SMTP port for the mail server
        $mail->Username = $this->username; // MAIL username
        $mail->Password = $this->password; // MAIL password

        //Typical mail data
        $mail->AddAddress('');
        $mail->SetFrom('', $name_from);
        $mail->Subject = "Nouveau rapport d'audit";
        $mail->Body =  "<p>Bonjour,</p>
                        <p> Nouveau rapport de <b>". $_SESSION['name'] . ' ' . $_SESSION['firstname'] . '</b> pour la société <b>' . $_SESSION['companyName'] ?? " ". "</b></p>";
        $mail->IsHTML();
        try{
            $mail->Send();
        } catch(Exception $e){
        }
    }*/

}
