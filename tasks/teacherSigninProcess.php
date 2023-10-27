<?php
session_start();
require "../connection/connection.php";

$uname = $_POST["un"];
$password = $_POST["pw"];
$code = $_POST["code"];
//validations
if (empty($uname)) {
    echo "username cannot be empty";
} else if (empty($password)) {
    echo "password cannot be empty";
} else {
    $r = Database::select("SELECT * FROM `teacher` WHERE `user_name`='" . $uname . "' AND `password`='" . $password . "'");//check username and password
    $n = $r->num_rows;
    if (!$n == 1) {//if no row found
        echo "wrong username or password";
    } else {

        
        $d = $r->fetch_assoc();
        if($d["status_id"]=='2'){//fee paid=2 means his grade has benn updated by the admin. student has to pay an enrollment fee to signin to his account
            echo "Your account has been deactivated. <br>Please contact the admin";
        }else{
            $c = $d["code"];
            if ($c == null) {
                if (!empty($code)) {//if the code is null and $code is not empty then this is an verified user thus error
                    echo "verification code is expired";
                }else{
                    echo "success";
                    $_SESSION["teacher"] = $d;//comes to here if it is verified user login session created
                }
            } else {
                if (empty($code)) {//if the code is not null and $code is empty then unverified user nedds the code but no code recieved thus error
                    echo "Please enter the verification code";
                } else {//unverified user with a code
                    if ($c == $code) {//if it is the matching code
    
                        Database::uid("UPDATE `teacher` SET `account_status`='1',`code`='' WHERE `teacher_id`='" . $d["teacher_id"] . "'");//empty the code in table
                       $ndr =  Database::select("SELECT * FROM `teacher` WHERE `teacher_id`='".$d['teacher_id']."'");
                        $nd = $ndr->fetch_assoc();
                        $_SESSION["teacher"] = $nd;//session created
                        echo "success";
                    }
                }
            }
        }
        
    }
}