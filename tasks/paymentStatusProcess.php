<?php
session_start();
require "../connection/connection.php";

if (isset($_SESSION["admin"])) {
    //only admin allows to change the payment status
    $id = $_GET["id"];

    $s = Database::select("SELECT * FROM `student` WHERE `student_id`='" . $id . "'"); //looking for student with student Id
    $sn = $s->num_rows; //no of rows

    if ($sn == 1) { //if the number of rows  = 1
        $sr = $s->fetch_assoc();
        //update the student tables fee paid 
        Database::uid("UPDATE `student` SET `fee_paid`='1' WHERE `student_id`='" . $sr["student_id"] . "'");
        echo "success";
    }
}
