<?php
session_start();
//php mailer file reqiured
require "../connection/connection.php";

use PHPMailer\PHPMailer\PHPMailer;

require '../phpMailer/Exception.php';
require '../phpMailer/PHPMailer.php';
require '../phpMailer/SMTP.php';


$un = $_GET["un"];


if (empty($un)) {
    echo "please enter your username in the relevant field";
} else {
    //
    $s = Database::select("SELECT * FROM `student` WHERE `user_name`='" . $un . "'");
    $sn = $s->num_rows;

    if ($sn != 1) {
        echo "Invalid username";
    } else {
        $sr = $s->fetch_assoc();
        echo $sr["code"];
        if ($sr["account_status"]==1) {
            $code = uniqid();
            
            $email = $sr["email"];

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com'; //our email provider company use this for gmail only
            $mail->SMTPAuth = true;
            $mail->Username = 'hansasolutions00@gmail.com'; //sending email(my email)
            $mail->Password = 'MSI2022w11'; //sending email(my email) password
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('hansasolutions00@gmail.com', 'SMS'); //sending email
            $mail->addReplyTo('hansasolutions00@gmail.com', 'SMS'); //reply mail
            $mail->addAddress($email); //recieving email
            $mail->isHTML(true);
            $mail->Subject = 'Forgot Password Verification Code'; //email subject
            $bodyContent = '<div style="text-align:center";>
        
            <h2>Please use the verification code below to change your password
            
                        <p>Your Verification code is <b>' . $code . '</b></p>
        
        </div>
        
                        
                    <div style="text-align:center; margin-top : 20px;">
                    &copy; 2022 javaSchool.edu All Rights Reserved
                    </div>'; //email content

            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            } else {
                Database::uid("UPDATE `student` SET `code`='".$code."' WHERE `student_id`='".$sr["student_id"]."'");
                echo "success";
            }
        } else {
            
            echo "you are here for the first time.<br> Please check the inbox find the password";
        }
    }
}
