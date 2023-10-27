<?php
require "../connection/connection.php";

$t = $_POST["t"];
$s = $_POST["s"];
$g = $_POST["g"];

if ($t == 0 || $s == 0 || $g == 0) {
    echo "please select all the fields";
} else {
    //check whether row with the same combination exists
    $r = Database::select("SELECT * FROM `teacher_has_grade_has_subject` WHERE `teacher_id`='" . $t . "' AND `subject_id`='" . $s . "' AND `grade_id`='" . $g . "'");
    $n = $r->num_rows;
    if ($n > 0) {
        //if exists
        echo "this subject and grade is already assin to teacher";
    } else {
        //if not
        Database::uid("INSERT INTO `teacher_has_grade_has_subject` (`teacher_id`,`grade_id`,`subject_id`) VALUES ('" . $t . "','" . $g . "','" . $s . "')");//insert the record
        echo "success";
    }
}
