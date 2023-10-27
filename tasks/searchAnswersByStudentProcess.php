<?php
session_start();
require "../connection/connection.php";

if (isset($_SESSION["teacher"])) { //if the teacher session set
    $ass_id = $_POST["ass_id"];
    $sname = $_POST["sname"];

?>
    <div class="col-4 offset-8">
        <div class="input-group">

            <input type="text" class="form-control" placeholder="Search by Student" id="sname">
            <!--input field use to search student by thier first name-->
            <button class="btn btn-primary" onclick="searchByStudent(<?php echo $ass_id ?>)"><i class='bx bx-search'></i></button>
        </div>
    </div>
    <!--will load the whole table to a div including the search field-->
    <div class="col-12">
    <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" style="height: 500px;">
    <table class="table">
        <tr>
            <td>Student Name</td>
            <td>Grade</td>
            <td>Added Date</td>
            <td></td>
        </tr>
        <?php
        if (empty($ass_id)) { //if assignment_id is empty

            echo "please enter assignment name";
        } else { //if not
            //search for the students answers by students first name using SQL wildcard
            $assr = Database::select("SELECT * FROM `student_answers` INNER JOIN `student` ON `student`.student_id=`student_answers`.student_id 
                                    WHERE `assignment_id`='" . $ass_id . "' AND `first_name` LIKE '" . $sname . "%'");
            $assn = $assr->num_rows; //number of rows

            if (!$assn > 0) {
                //if the number of rows are 0
        ?>
                <tr>
                    <td colspan="4">
                        <label for=""> No Answer Available</label>
                    </td>
                </tr>
                <?php

            } else {
                //loop throught the rows
                for ($u = 0; $u < $assn; $u++) {
                    $assfr = $assr->fetch_assoc(); //fetch each row to associative array
                    $stu = Database::select("SELECT * FROM `student` INNER JOIN `grade` ON `grade`.grade_id=`student`.grade_id WHERE `student_id`='" . $assfr["student_id"] . "'");
                    $sn = $stu->num_rows;

                    if ($sn == 1) {
                        $stuf = $stu->fetch_assoc();

                ?>
                        <tr>
                            <!--load the data to table rows-->
                            <td><?php echo $stuf["first_name"] . " " . $stuf["last_name"] ?></td>
                            <td>Grade <?php echo $stuf["grade_name"] ?></td>
                            <td><?php
                                $datee = $assfr["added_date"];
                                $splitdt = explode(" ", $datee);
                                echo $splitdt[0];
                                ?></td>
                            <td><a class="btn btn-success" href="tasks/downloadAnswersProcess.php?file=<?php echo $assfr["answer_file"] ?>">Download</button></a>
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
    </div>
    
<?php
}

?>