<?php
session_start();
require "../connection/connection.php";

if (isset($_SESSION["teacher"])) { //teacher session required

    $id = $_POST["ass"];
    $sname = $_POST["sname"];
    $marks = $_POST["marks"];
    //validations
    if ($id == '0') {
        echo "please select a assignment";
    } else if ($sname == '0') {
        echo "please select a student";
    } else if (empty($marks)) {
        echo "please add marks";
    } else {
        //select assignment by id
        $a = Database::select("SELECT * FROM `assignment` WHERE `assignment_id`='" . $id . "'");
        $an = $a->num_rows;

        if (!$an == 1) { //if theres no such a assignment
            echo "incorrect Details";
        } else {
            $ans = $a->fetch_assoc();
            $am = Database::select("SELECT * FROM `assignment_marks` WHERE `assignment_id`='" . $id . "' AND `student_id`='" . $sname . "'"); //search if the marks are already submitted
            if ($am->num_rows == 1) {
                echo "marks are already submitted";
            } else {
                $status = 0;
                //insert the marks in to the database
                Database::uid("INSERT INTO `assignment_marks` (`marks`,`student_id`,`assignment_id`,`status`) VALUES ('" . $marks . "','" . $sname . "','" . $id . "','" . $status . "')");
                echo "success";
            }
        }
    }
}
