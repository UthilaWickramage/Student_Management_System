<?php
//import php mailer
require "../connection/connection.php";

use PHPMailer\PHPMailer\PHPMailer;

require '../phpMailer/Exception.php';
require '../phpMailer/PHPMailer.php';
require '../phpMailer/SMTP.php';

$aid = $_POST["aid"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$uname = $_POST["uname"];
$email = $_POST["email"];
$password = $_POST["password"];
$status = $_POST["status"];
//verification process
if (empty($aid)) {
    echo "acedamic id cannot be empty";
} else if (strlen($aid) > 10) {
    echo "last name is too long";
} else if (empty($fname)) {
    echo "first name cannot be empty";
} else if (strlen($fname) > 45) {
    echo "First name is too long";
} else if (empty($lname)) {
    echo "Last name cannot be empty";
} else if (strlen($lname) > 45) {
    echo "last name is too long";
} else if (empty($uname)) {
    echo "User name cannot be empty";
} else if (strlen($uname) > 45) {
    echo "User name is too long";
} else if (empty($email)) {
    echo "Email cannot be empty";
} else if (strlen($email) > 45) {
    echo "Email is too long";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo  "enter a valid email address";
} else if (empty($password)) {
    echo "Password cannot be empty";
} else if (strlen($password) > 20) {
    echo "Password is too long";
} else {
     //check if theres another account with the same details
     $r = Database::select("SELECT * FROM `acedamic` WHERE `acedamic_id`='" . $aid . "' OR `email`='" . $email . "' OR `user_name`='" . $uname . "';");
     if ($r->num_rows > 0) {
         //if it is true
         echo "this email address is already registered";
     } else {
           //email sending part
    $code = uniqid();
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
    $mail->Subject = 'Your Academic Account is Ready!'; //email subject
    $bodyContent = '<div>
    <img src="https://ibb.co/nRctgCZ" height="200px" width="auto" />
    <h1 style="color: darkblue;">Student Management System</h1>
    <h2>You have been registered as an Academic Officer in our new student management system.</h2>
    <h3>Dear '.$fname.',</h3>
    <p>Please note that as a new user, you can sign in to your account using the username and password provided..</p>
    <p>Academic Id <b>' . $aid . '</b></p>
    <p>Your Verification code is <b>' . $code . '</b></p>
    <p>Your Username is <b>' . $uname . '</b></p>
    <p>Your Password is <b>' . $password . '</b></p>
    <h3> Good luck with your academic year</h3>
</div>


<div style="text-align:center; margin-top : 20px;">
    &copy; 2021 HunsTextiles.store All Rights Reserved
</div>'; //email content

    $mail->Body    = $bodyContent;

    if (!$mail->send()) {
        //shown if theres a error in sending the mail
        echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    } else {
        //if false
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimeZone($tz);
        $date = $d->format("Y-m-d H:i:s");

        //inserting new user to the academic table
        Database::uid("INSERT INTO `acedamic` (`acedamic_id`,`user_name`,`email`,`password`,`first_name`,`last_name`,`register_date`,`code`,`account_status`,`status_id`) VALUES ('" . $aid . "','" . $uname . "','" . $email . "','" . $password . "','" . $fname . "','" . $lname . "','" . $date . "','" . $code . "','" . $status . "','1')");
        echo "success";
    }
        
     }
  
}
