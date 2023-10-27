<?php
require "../connection/connection.php";

$code = $_POST["code"];
$nw = $_POST["nw"];
$cw = $_POST["cw"];
//validation
if (empty($code)) {
    echo "please enter the verification code";
} else if (empty($nw)) {
    echo "please enter the new password";
} else if (empty($cw)) {
    echo "please enter the confirm password";
} else if ($nw != $cw) {
    echo "New password and confirm password should be the same";
} else {
//check wherther theres such a code
    $s = Database::select("SELECT * FROM `acedamic` WHERE `code`='" . $code . "'");
    $sn = $s->num_rows;//no of rows 

    if ($sn == 1) {//if its 1
        $sr = $s->fetch_assoc();
        $sid = $sr["acedamic_id"];
        
//update academic table
        Database::uid("UPDATE `acedamic` SET `password`='" . $nw . "', `code`='' WHERE `acedamic_id`='" . $sid . "'");
        echo "success";
    } else {
        echo 'Incorrect verification code';
    }
}
