<?php
session_start();
require "../connection/connection.php";

$uname = $_POST["un"];
$password = $_POST["pw"];
$code = $_POST["code"];

if (empty($uname)) {
    echo "username cannot be empty";
} else if (empty($password)) {
    echo "password cannot be empty";
} else {
    $r = Database::select("SELECT * FROM `acedamic` WHERE `user_name`='" . $uname . "' AND `password`='" . $password . "'");//select user by username and password
    $n = $r->num_rows;
    if (!$n == 1) {//if its 0
        echo "wrong username or password";
    } else {
        $d = $r->fetch_assoc();

        if($d["status_id"]=='2'){//check for status
            echo "Your account has been deactivated. <br>Please contact the admin";
        }else{
            $c = $d["code"];
            if ($c == null) {
                if (!empty($code)) {//if the code is null and $code is not empty then this is an verified user thus error
                    echo "verification code is expired";
                }else{
                    echo "success";
                    $_SESSION["officer"] = $d;//comes to here if it is verified user login session created
                }
            } else {
                if (empty($code)) {//if the code is not null and $code is empty then unverified user nedds the code but no code recieved thus error
                    echo "Please enter the verification code";
                } else {//unverified user with a code
                    if ($c == $code) {//if it is the matching code
    
                        Database::uid("UPDATE `acedamic` SET `account_status`='1',`code`='' WHERE `acedamic_id`='" . $d["acedamic_id"] . "'");//empty the code
                        $ndr =  Database::select("SELECT * FROM `acedamic` WHERE `acedamic_id`='".$d['acedamic_id']."'");
                            $nd = $ndr->fetch_assoc();
                            $_SESSION["acedamic"] = $nd;//session created
                        echo "success";
                    }
                }
            }
        }
        
    }
}
