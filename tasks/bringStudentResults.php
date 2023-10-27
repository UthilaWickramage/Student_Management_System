<?php
session_start();
require "../connection/connection.php";


if (isset($_SESSION["teacher"])) { //if teacher session exists


    if (!empty($_GET["id"])) {
        $id = $_GET["id"];
        //select assignments with assignment id
        $r = Database::select("SELECT * FROM `assignment` WHERE `assignment_id`='" . $id . "'");
        $rn = $r->num_rows;

        if (!$rn == 1) { //if no such a id
?>
            <option value="0">Incorrect Assignment Id</option>
            <?php
        } else {
            $rf = $r->fetch_assoc(); //assoc array

            $row = Database::select("SELECT * FROM `teacher_has_grade_has_subject` WHERE `id`='" . $rf["teacher_has_grade_has_subject_id"] . "'");
            $rown = $row->num_rows;

            if (!$rown == 1) {
            ?>
                <option value="0">Incorrect Id</option>
                <?php
            } else {
                $rowf = $row->fetch_assoc();
                //select all tudent in the grade
                $student = Database::select("SELECT * FROM `student` WHERE `grade_id`='" . $rowf["grade_id"] . "'");
                $studentn = $student->num_rows;

                if (!$studentn > 0) {
                ?>
                    <option value="0">No Students Available</option>
                    <?php
                } else {
                    for ($i = 0; $i < $studentn; $i++) { //loop through rows
                        $studentrow = $student->fetch_assoc(); //assoc arrays

                    ?>
                        <option value="<?php echo $studentrow["student_id"] ?>"><?php echo $studentrow["first_name"] . " " . $studentrow["last_name"] ?></option>
        <?php
                    }
                }
            }
        }
    } else {
        ?>
        <option value="0">Incorrect Assignment Id</option>
<?php
    }
}
