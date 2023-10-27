<?php
session_start();
require "../connection/connection.php";
$un = $_POST["un"];
$fn = $_POST["fn"];
$ln = $_POST["ln"];
$id = $_POST["id"];
//get post parameters

if (isset($_SESSION["teacher"])) {// if the session is teacher
    //validations
    if (empty($un)) {
        echo "username field cannot be empty";
    } else if (empty($fn)) {
        echo "first name field cannot be empty";
    } else if (empty($ln)) {
        echo "last name field cannot be empty";
    } else {
        Database::select("UPDATE `teacher` SET `first_name`='" . $fn . "',`last_name`='" . $ln . "',`user_name`='" . $un . "' WHERE `teacher_id`='" . $id . "'");//update profile 
        echo "success";
    }
} else if (isset($_SESSION["officer"])) {// if the session is officer
    //validations
    if (empty($un)) {
        echo "username field cannot be empty";
    } else if (empty($fn)) {
        echo "first name field cannot be empty";
    } else if (empty($ln)) {
        echo "last name field cannot be empty";
    } else {
        Database::select("UPDATE `acedamic` SET `first_name`='" . $fn . "',`last_name`='" . $ln . "',`user_name`='" . $un . "' WHERE `acedamic_id`='" . $id . "'");//update profile
        echo "success";
    }
} else if (isset($_SESSION["student"])) {// if the session is student
    //validations
    if (empty($un)) {
        echo "username field cannot be empty";
    } else if (empty($fn)) {
        echo "first name field cannot be empty";
    } else if (empty($ln)) {
        echo "last name field cannot be empty";
    } else {
        Database::select("UPDATE `student` SET `first_name`='" . $fn . "',`last_name`='" . $ln . "',`user_name`='" . $un . "' WHERE `student_id`='" . $id . "'");//update profile
        echo "success";
    }
}
