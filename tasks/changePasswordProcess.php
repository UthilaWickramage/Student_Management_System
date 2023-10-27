<?php
session_start();
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
} else {//if everything is fine
    if (isset($_SESSION["student"])) {//session should be student
        $sid = $_SESSION["student"]["student_id"];

        $sr = Database::select("SELECT * FROM `student` WHERE `student_id`='" . $sid . "'");//search for student details
        $sn = $sr->num_rows;//no of rows
        if ($sn == 1) {
            $s = $sr->fetch_assoc();

            if ($code == $s["code"]) {//if code is right
                Database::uid("UPDATE `student` SET `password`='" . $nw . "', `code`='' WHERE `student_id`='" . $s["student_id"] . "'");//update student password
                echo "success";
            } else {
                echo "Invalid verification code";
            }
        }
    } else if (isset($_SESSION["teacher"])) {//session should be teacher
        $tid = $_SESSION["teacher"]["teacher_id"];
        $sr = Database::select("SELECT * FROM `teacher` WHERE `teacher_id`='" . $tid . "'");//search for teacher details
        $sn = $sr->num_rows;
        if ($sn == 1) {
            $s = $sr->fetch_assoc();

            if ($code == $s["code"]) {//if code is right
                Database::uid("UPDATE `teacher` SET `password`='" . $nw . "', `code`='' WHERE `teacher_id`='" . $s["teacher_id"] . "'");//update teacher password
                echo "success";
            } else {
                echo "Invalid verification code";
            }
        }
    } else if (isset($_SESSION["officer"])) {//session should be officer
        $oid = $_SESSION["officer"]["acedamic_id"];
        $sr = Database::select("SELECT * FROM `acedamic` WHERE `acedamic_id`='" . $oid . "'");//search for officer details
        $sn = $sr->num_rows;
        if ($sn == 1) {
            $s = $sr->fetch_assoc();

            if ($code == $s["code"]) {//if code is right
                Database::uid("UPDATE `acedamic` SET `password`='" . $nw . "', `code`='' WHERE `acedamic_id`='" . $s["acedamic_id"] . "'");//update officer password
                echo "success";
            } else {
                echo "Invalid verification code";
            }
        }
    }
}
