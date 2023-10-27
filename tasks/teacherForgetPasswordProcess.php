<?php
session_start();
require "../connection/connection.php";

use PHPMailer\PHPMailer\PHPMailer;

require '../phpMailer/Exception.php';
require '../phpMailer/PHPMailer.php';
require '../phpMailer/SMTP.php';


$un = $_GET["un"];


if (empty($un)) {//
    echo "please enter your username in the relevant field";
} else {
    $s = Database::select("SELECT * FROM `teacher` WHERE `user_name`='" . $un . "'");
    $sn = $s->num_rows;

    if ($sn != 1) {
        echo "Invalid username";
    } else {
        $sr = $s->fetch_assoc();
        if ($sr["account_status"]==1) {
            $code = uniqid();

            $email = $sr["email"];

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com'; //our email provider company use this for gmail only
            $mail->SMTPAuth = true;
            $mail->Username = 'hansasolutions00@gmail.com'; //sending email(my email)
            $mail->Password = 'jnpdbgjwjhvneauo'; //sending email(my email) password
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('hansasolutions00@gmail.com', 'SMS'); //sending email
            $mail->addReplyTo('hansasolutions00@gmail.com', 'SMS'); //reply mail
            $mail->addAddress($email); //recieving email
            $mail->isHTML(true);
            $mail->Subject = 'Forgot Password Verification Code'; //email subject
            $bodyContent = '<div>
        <h4>Dear Teacher,</h4>
            Please use the verification code below to change your password
            
                       Your Verification code is <b>' . $code . '
        
        </div>
        
                        
                    <div style="text-align:center; margin-top : 20px;">
                    &copy; 2022 javaSchool.edu All Rights Reserved
                    </div>'; //email content

            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            } else {
                Database::uid("UPDATE `teacher` SET `code`='" . $code . "' WHERE `teacher_id`='" . $sr["teacher_id"] . "'");//update teacher
                echo "success";
            }
        } else {//if user click this option without signin once

            echo "you are here for the first time.<br> Please check the inbox find the password";
        }
    }
}
