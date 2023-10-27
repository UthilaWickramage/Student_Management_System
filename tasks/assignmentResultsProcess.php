<?php
session_start();
require "../connection/connection.php";

if (isset($_SESSION["officer"])) {
    $ass_id = $_GET["id"];
?>
  <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" style="height: 500px;">
    <table class="table">
        <tr class="fw-bold">
            <td>Student Name</td>
            <td>Grade</td>
            <td>Marks</td>
            <td>Status</td>
            <td>Action</td>
        </tr>
        <?php
        if (empty($ass_id)) { //whether assignment id is empty

            echo "please enter assignment name";
        } else {
            $assr = Database::select("SELECT * FROM `assignment_marks` WHERE `assignment_id`='" . $ass_id . "'"); //if theres any rows with that assignment id in assgnment marks table
            $assn = $assr->num_rows;

            if (!$assn > 0) {
        ?>
                <tr>
                    <td colspan="4">
                        <label for=""> No Marks Available</label>
                    </td>
                </tr>
                <?php

            } else {
                for ($u = 0; $u < $assn; $u++) {
                    $assfr = $assr->fetch_assoc();
                    //get the student row for the student id in the assignment marks row
                    $stu = Database::select("SELECT * FROM `student` INNER JOIN `grade` ON `grade`.grade_id=`student`.grade_id WHERE `student_id`='" . $assfr["student_id"] . "'");
                    $sn = $stu->num_rows;

                    if ($sn == 1) {
                        $stuf = $stu->fetch_assoc();

                ?>
                        <tr>
                            <td><?php echo $stuf["first_name"] . " " . $stuf["last_name"] ?></td>
                            <td>Grade <?php echo $stuf["grade_name"] ?></td>
                            <td><?php echo $assfr["marks"] ?></td>
                            <?php
                            if ($assfr["status"] == '0') {
                            ?>
                                <td>
                                    <div id="s" class="badge rounded-pill alert-danger">Yet to be Released</div>
                                </td>
                                <td><a class="btn btn-success btn-sm" onclick="marksStatesChanged(<?php echo $assfr['assignment_marks_id'] ?>)">Release Marks</button></a>
                                    <!--when clicked the marks will be releases to the students-->


                                <?php
                            } else {
                                ?>
                                <td>
                                    <div id="s" class="badge rounded-pill alert-success ">Released</div>
                                </td>
                                <td><button class="btn btn-success btn-sm" disabled>Release Marks</button></a>
                                    <!--button is not clickable if the marks already been released-->
                                <?php
                            }
                                ?>

                            <?php
                        } else {
                            ?>



                        </tr>
            <?php
                        }
                    }
                }
            ?>


        <?php
        }
        ?>
    </table>
    </div>
<?php
}

?>