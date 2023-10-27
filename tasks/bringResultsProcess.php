<?php
session_start();
require "../connection/connection.php";

if (isset($_SESSION["student"])) {
    $s = $_POST["stu"];
    $a = $_POST["ass"];
    $subject = $_POST["sub"];
    //search assignment marks
    $r = Database::select("SELECT * FROM assignment_marks INNER JOIN student ON student.student_id=assignment_marks.student_id 
                            WHERE assignment_marks.assignment_id='" . $a . "' AND student.student_id='" . $s . "' AND assignment_marks.`status`='1'");
    $rn = $r->num_rows;
    if ($rn == 1) {
        $rf = $r->fetch_assoc();
        //creating the result sheet here and load it in to a div through javascript

        //start of the div will be loaded into the user interface
?>
        <div class="col-12">
            <label class="form-label">Student Full Name:</label>
            <label class="form-label fw-bolder"><?php echo $rf["first_name"] . " " . $rf["last_name"] ?></label>
        </div>

        <div class="col-12 mt-3">
            <table class="table table-bordered">
                <tr class="fw-bold">
                    <td>#</td>
                    <td>Subject</td>
                    <td>Marks</td>
                </tr>
                <tr>
                    <td><?php echo $rf["assignment_marks_id"] ?></td>
                    <td>
                        <?php
                        //select all subjects
                        $sub = Database::select("SELECT * FROM `subject` WHERE `subject_id`='" . $subject . "'");
                        $subr = $sub->fetch_assoc();

                        echo $subr["subject_name"];
                        ?>
                    </td>
                    <td>
                        <?php echo $rf["marks"] ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        Total marks
                    </td>
                    <td>
                        <?php echo $rf["marks"] ?> out of 100
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        Percentage
                    </td>
                    <td class="fw-bold">
                        <?php echo $rf["marks"] ?>%
                    </td>
                </tr>
            </table>
        </div>
       
    <?php
     //start of the div will be loaded into the user interface
    } else {//if no results available
    ?>
        <div class="col-12 mt-5 mb-5 d-flex justify-content-center">
            <h3 class=" text-black-50">Results Yet to be released</h3>
        </div>

<?php
    }
}


?>