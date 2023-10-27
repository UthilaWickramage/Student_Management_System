<?php
session_start();
require "../connection/connection.php";

if (isset($_SESSION["teacher"])) {//session has to teacher
    $ass_id = $_GET["ass"];//get the ass id 
    //start of the content that will be displayed in the client side
?>
    <div class="col-4 offset-8">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search by Student" id="sname">
            <button class="btn btn-primary" onclick="searchByStudent(<?php echo $ass_id ?>)"><i class='bx bx-search'></i></button><!--search by student with the assignment id as a parameter-->
        </div>
    </div>
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
        if (empty($ass_id)) {//if no assignment selected

            echo "please enter assignment name";
        } else {
            //search answer table by assignent id this will give every answer record with that assignment
            $assr = Database::select("SELECT * FROM `student_answers` WHERE `assignment_id`='" . $ass_id . "'");
            $assn = $assr->num_rows;

            if (!$assn >0) {//if no row found
        ?>
                <tr>
                    <td colspan="4">
                        <label for=""> No Answer Available</label>
                    </td>
                </tr>
                <?php

            } else {
                for ($u = 0; $u < $assn; $u++) {//loop through rows
                    $assfr = $assr->fetch_assoc();
                    //sewarch for student from student id in the answer row
                    $stu = Database::select("SELECT * FROM `student` INNER JOIN `grade` ON `grade`.grade_id=`student`.grade_id WHERE `student_id`='" . $assfr["student_id"] . "'");
                    $sn = $stu->num_rows;

                    if ($sn == 1) {//if a student found
                        $stuf = $stu->fetch_assoc();//assoc array and fill the table row

                ?>
                        <tr>
                            <td><?php echo $stuf["first_name"] . " " . $stuf["last_name"] ?></td>
                            <td>Grade <?php echo $stuf["grade_name"] ?></td>
                            <td><?php
                                $datee = $assfr["added_date"];
                                $splitdt = explode(" ", $datee);
                                echo $splitdt[0];
                                ?></td>
                            <td><a class="btn btn-success" href="tasks/downloadAnswersProcess.php?file=<?php echo $assfr["answer_file"]?>">Download</button></a>
                            <!--can download answer by clicking link will redirected to the downloadanswerprocess page with name of the answer file as a get paramenter-->
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
 //end of the content that will be displayed in the client side
}

?>