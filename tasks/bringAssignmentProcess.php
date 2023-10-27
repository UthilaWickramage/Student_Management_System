<?php
session_start();
require "../connection/connection.php";

if (isset($_SESSION["student"])) {
    $g = $_POST["g"];
    $s = $_POST["s"];
    //search for teacher_has_grade_has_subject_id for two ids
    $r = Database::select("SELECT * FROM `teacher_has_grade_has_subject` WHERE `grade_id`='" . $g . "' AND `subject_id`='" . $s . "'");
    $rf = $r->fetch_assoc();
//search the assignment table for assignments for that teacher_has_grade_has_subject_id
    $ass = Database::select("SELECT * FROM `assignment` WHERE `teacher_has_grade_has_subject_id`='" . $rf["id"] . "'");
    $assn = $ass->num_rows;

    if ($assn > 0) {
        ?>
<option value="0">Select Assignment</option>
        <?php
        for ($i = 0; $i < $assn; $i++) {
            //load the option to the select tag
            $assf = $ass->fetch_assoc();
?>
            <option value="<?php echo $assf["assignment_id"] ?>"><?php echo $assf["assignment_name"] ?></option>
        <?php
        }
    } else {
        ?>
        <option value="0">No Assignments Available</option>
<?php
    }
}


?>