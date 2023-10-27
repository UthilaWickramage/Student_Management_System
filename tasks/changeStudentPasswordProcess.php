<?php
require "../connection/connection.php";

$code = $_POST["code"];
$nw = $_POST["nw"];
$cw = $_POST["cw"];

if (empty($code)) {
    echo "please enter the verification code";
} else if (empty($nw)) {
    echo "please enter the new password";
} else if (empty($cw)) {
    echo "please enter the confirm password";
} else if ($nw != $cw) {
    echo "New password and confirm password should be the same";
} else {
//search the code from student
    $s = Database::select("SELECT * FROM `student` WHERE `code`='" . $code . "'");
    $sn = $s->num_rows;

    if ($sn == 1) {//if found the code
        $sr = $s->fetch_assoc();
        $sid = $sr["student_id"];
        

        Database::uid("UPDATE `student` SET `password`='" . $nw . "', `code`='' WHERE `student_id`='" . $sid . "'");//update password in students
        echo "success";
    } else {
        echo 'Incorrect verification code';
    }
}
