<?php
session_start();
require "../connection/connection.php";
if (isset($_SESSION["student"])) {//student session required
    $subject = $_GET["s"];
    $grade_id = $_SESSION["student"]["grade_id"];

    if (empty($subject)) {
        echo "please search by subject";
    } else {
        //search for details with grade id and subject ids
        $ar = Database::select("SELECT *
        FROM teacher_has_grade_has_subject
        INNER JOIN teacher ON teacher_has_grade_has_subject.teacher_id = teacher.teacher_id
        INNER JOIN subject ON subject.subject_id = teacher_has_grade_has_subject.subject_id
        INNER JOIN grade ON grade.grade_id = teacher_has_grade_has_subject.grade_id
        INNER JOIN lesson_notes ON lesson_notes.teacher_has_grade_has_subject_id = teacher_has_grade_has_subject.id
        WHERE teacher_has_grade_has_subject.grade_id = '" . $grade_id . "' AND subject.subject_name LIKE '" . $subject . "%' ");
        $an = $ar->num_rows;
        //start of the content that will be displayed in the client side
?>
        <table class="table">
            <tr class="fw-bold">
                <td>Subject</td>
                <td>Teacher</td>
                <td>Description</td>
                <td>Added Date</td>
                <td></td>

            </tr>

            <?php

            if (!$an > 0) {//if no row found
                ?>

                <tr>
                    <td colspan="5" class="text-center">No Lesson Notes Available</td>
                </tr>
                <?php
            } else {

                $class = array('alert-success', 'alert-info', 'alert-warning', 'alert-danger', 'alert-primary');//class array to loop through class for background color of row
                $classbtn = array('btn-success', 'btn-info');
                for ($z = 0; $z < $an; $z++) {//loop through rows
                    $assf = $ar->fetch_assoc();//assoc array and fill the row
            ?>
                    <tr class="alert <?php echo $class[$z] ?>">
                        <td>Grade <?php echo $assf["grade_name"] . " " . $assf["subject_name"] ?></td>
                        <td><?php echo $assf["first_name"] . " " . $assf["last_name"] ?></td>
                        <td><?php echo $assf["description"] ?></td>
                        <td><?php
                            $datee = $assf["added_date"];
                            $splitdt = explode(" ", $datee);
                            echo $splitdt[0];
                            ?></td>

                        <td><a href="tasks/downloadLessonsProcess.php?file=<?php echo $assf["lesson_file"] ?>" class="btn <?php echo $classbtn[$z] ?> btn-sm">Download</a></td>
  <!--can download lessons by clicking link will redirected to the downloadlessonsprocess page with name of the lesson file as a get paramenter-->
                    </tr>

                <?php
                }
                ?>
        </table>
<?php
 //end of the content that will be displayed in the client side
            }
        }
    }
