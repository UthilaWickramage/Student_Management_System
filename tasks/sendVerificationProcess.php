<?php
session_start();
require "../connection/connection.php";

use PHPMailer\PHPMailer\PHPMailer;

require '../phpMailer/Exception.php';
require '../phpMailer/PHPMailer.php';
require '../phpMailer/SMTP.php';

$code = uniqid();

if (isset($_SESSION["student"])) {//for student
    $sid = $_SESSION["student"]["student_id"];
    $email = $_SESSION["student"]["email"];
    $fname = $_SESSION["student"]["first_name"];

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
    $mail->Subject = 'Update Password Verification Code'; //email subject
    $bodyContent = '<div>
    <img src="https://cdn-icons.flaticon.com/png/512/2936/premium/2936719.png?token=exp=1654707717~hmac=b3e65da0f30f964267e9859fa80a6e55" height="200px" width="auto" />
    <h1 style="color: darkblue;">Student Management System</h1>
    <h3>Dear '.$fname.',</h3>
    <h2>Please use the below verification code to change the password</h2> 
    <p>Student Id <b>' . $sid . '</b></p>
    <p>Your Verification code is <b>' . $code . '</b></p>
  
    
</div>


<div style="text-align:center; margin-top : 20px;">
    &copy; 2021 HunsTextiles.store All Rights Reserved
</div>'; //email content

    $mail->Body    = $bodyContent;

    if (!$mail->send()) {
        echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    } else {
        Database::uid("UPDATE `student` SET `code`='" . $code . "' WHERE `student_id`='" . $sid . "'");//update the student table
        echo "success";
    }
} else if (isset($_SESSION["teacher"])) {//for teacher
    $tid = $_SESSION["teacher"]["teacher_id"];
    $email = $_SESSION["teacher"]["email"];
    $fname = $_SESSION["teacher"]["first_name"];

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
    $mail->Subject = 'Update Password Verification Code'; //email subject
    $bodyContent = '<div>
    <img src="https://cdn-icons.flaticon.com/png/512/2936/premium/2936719.png?token=exp=1654707717~hmac=b3e65da0f30f964267e9859fa80a6e55" height="200px" width="auto" />
    <h1 style="color: darkblue;">Student Management System</h1>
    <h3>Dear '.$fname.',</h3>
    <h2>Please use the below verification code to change the password</h2> 
    <p>Student Id <b>' . $tid . '</b></p>
    <p>Your Verification code is <b>' . $code . '</b></p>
  
    
</div>


<div style="text-align:center; margin-top : 20px;">
    &copy; 2021 HunsTextiles.store All Rights Reserved
</div>'; //email content

    $mail->Body    = $bodyContent;

    if (!$mail->send()) {
        echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    } else {
        Database::uid("UPDATE `teacher` SET `code`='" . $code . "' WHERE `teacher_id`='" . $tid . "'");//update the teacher table
        echo "success";
    }
} else if (isset($_SESSION["officer"])) {//for academic officer
    $tid = $_SESSION["officer"]["acedamic_id"];
    $email = $_SESSION["officer"]["email"];
    $fname = $_SESSION["officer"]["first_name"];

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
    $mail->Subject = 'Update Password Verification Code'; //email subject
    $bodyContent = '<div>
    <img src="https://cdn-icons.flaticon.com/png/512/2936/premium/2936719.png?token=exp=1654707717~hmac=b3e65da0f30f964267e9859fa80a6e55" height="200px" width="auto" />
    <h1 style="color: darkblue;">Student Management System</h1>
    <h3>Dear '.$fname.',</h3>
    <h2>Please use the below verification code to change the password</h2> 
    <p>Student Id <b>' . $tid . '</b></p>
    <p>Your Verification code is <b>' . $code . '</b></p>
  
    
</div>


<div style="text-align:center; margin-top : 20px;">
    &copy; 2021 HunsTextiles.store All Rights Reserved
</div>'; //email content

    $mail->Body    = $bodyContent;

    if (!$mail->send()) {
        echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    } else {
        Database::uid("UPDATE `acedamic` SET `code`='" . $code . "' WHERE `acedamic_id`='" . $tid . "'");//update the the acdmic table
        echo "success";
    }
}
