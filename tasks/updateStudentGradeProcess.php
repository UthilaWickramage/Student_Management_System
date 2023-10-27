<?php
session_start();
require "../connection/connection.php";

if (isset($_SESSION["admin"])) { //only admin allow to upgrade student grade. so session should be admin
    $sid = $_POST["sid"];
    $gid = $_POST["gid"];
    //seach for the student with student id
    $g = Database::select("SELECT * FROM `student` WHERE `student_id`='" . $sid . "'");
    $gr = $g->num_rows; //no of rows

    if ($gr == 1) { //if nor =1 then,
        Database::uid("UPDATE `student` SET `grade_id`='" . $gid . "', `fee_paid`='2' WHERE `student_id`='" . $sid . "'"); //update students grade in student table
        echo "success";
    } else {
        echo "no such id"; //if no rows are not equal to 1
    }
}

//fee paid = 0; due payment after the free trial. due first payment.
//fee paid = 1; a payment has been made .
//fee paid = 2; students grade has been upgraded. due enrollment fee
