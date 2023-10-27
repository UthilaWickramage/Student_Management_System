<?php
session_start();
require "connection/connection.php";
if (isset($_SESSION["student"])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/bootstrap.css">
        <link rel="stylesheet" href="styles/sidebar.css">
        <link rel="stylesheet" href="styles/style.css">
        <link rel="icon" href="Resources/icons8-education-32.png">
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student | Download Assignments</title>

    </head>

    <body>
        <?php
        require "components/aside.php";
        ?>
        <section class="home-section">
            <?php
            require "./components/header.php";
            ?>
            <div class="row">
                <div class="col-10 offset-1">
                    <div class="card bg-light p-3 mt-3">
                        <div class="row mt-2">
                            <div class="col-12">
                                <h4 class="text-black-50">Download Assignments</h1>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" style="height: 500px;">
                                <table class="table">
                                    <?php
                                    //select all subjects available for the students grade
                                    $ar = Database::select("SELECT *
                                                FROM teacher_has_grade_has_subject
                                                INNER JOIN subject ON subject.subject_id= teacher_has_grade_has_subject.subject_id
                                                WHERE grade_id = '" . $_SESSION["student"]["grade_id"] . "'; ");
                                    $an = $ar->num_rows; //no of rows
                                    $assf;
                                    $af;

                                    for ($i = 0; $i < $an; $i++) { //loop through rows
                                        $af = $ar->fetch_assoc(); //assoc arrays
                                    ?>
                                        <tr>
                                            <td colspan="7">
                                                <div class="alert alert-success"><?php echo $af["subject_name"] ?></div>
                                            </td>
                                        </tr>
                                        <tr class="fw-bold">
                                            <td>Assignment Name</td>
                                            <td>Teacher</td>
                                            <td>Duration</td>
                                            <td>Added Date</td>
                                            <td>Deadline</td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                        <?php
                                        //select query searching assignments
                                        $ass = Database::select("SELECT *
                                        FROM teacher_has_grade_has_subject
                                        INNER JOIN teacher ON teacher_has_grade_has_subject.teacher_id = teacher.teacher_id
                                        INNER JOIN assignment ON assignment.teacher_has_grade_has_subject_id = teacher_has_grade_has_subject.id
                                        WHERE teacher_has_grade_has_subject.grade_id = '" . $af["grade_id"] . "' AND teacher_has_grade_has_subject.subject_id = '" . $af["subject_id"] . "';");

                                        $assn = $ass->num_rows; //no of rows

                                        if (!$assn > 0) { //if no rows available
                                        ?>

                                            <tr>
                                                <td colspan="7" class="text-center">No Assignment Available</td>
                                            </tr>
                                            <?php
                                        } else {
                                            for ($z = 0; $z < $assn; $z++) { //loop through rows
                                                $assf = $ass->fetch_assoc(); //assoc arrays
                                            ?>
                                                <tr>
                                                    <td><?php echo $assf["assignment_name"] ?></td>
                                                    <td><?php echo $assf["first_name"] . " " . $assf["last_name"] ?></td>
                                                    <td><?php echo $assf["duration"] ?></td>
                                                    <td><?php
                                                        $datee = $assf["register_date"];
                                                        $splitdt = explode(" ", $datee);
                                                        $rdate =  $splitdt[0];
                                                        echo $rdate;
                                                        ?></td>
                                                    <td><?php
                                                        $ddatee =  $assf["dead_line"];
                                                        $dsplitdt = explode(" ", $ddatee);
                                                        $ddate =  $dsplitdt[0];
                                                        echo $ddate;
                                                        ?></td>

                                                    <?php

                                                    //query to search student answers by assignment and student id
                                                    $ans = Database::select("SELECT * FROM `student_answers` WHERE `student_id`='" . $_SESSION["student"]["student_id"] . "' AND `assignment_id`='" . $assf["assignment_id"] . "'");
                                                    $ansn = $ans->num_rows; //no of rows

                                                    if ($ansn == 1) { //if theres an answer available then
                                                    ?>
                                                        <td colspan="2"><label class="form-label text-success fw-bold ">Submitted</label></td>
                                                    <?php
                                                    } else if ($ansn == 0 &&  $ddate < date("Y-m-d")) { // if theres no answers and end of the deadline
                                                        //checks if the deadline date is less than current date
                                                    ?>
                                                        <td colspan="2"><label class="form-label text-success fw-bold ">Not Submitted</label></td>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <td><a href="tasks/downloadAssignmentProcess.php?file=<?php echo $assf["assignment_file"] ?>" class="btn btn-success btn-sm">Download</a></td>
                                                        <!--send the assignment file name as a parameter to identify the file-->
                                                        <td>
                                                            <!-- <input type="file" class="d-none" id="ansUploader"> -->
                                                            <a id="uploadBtn" class="btn btn-sm" style="color: white; background-color: purple;" onclick="uploadModel(<?php echo $assf['assignment_id'] ?>)">Upload</a>
                                                            <!--send the assignment id as a parameter to identify the assignment-->
                                                        </td>
                                                    <?php
                                                    }

                                                    ?>
                                                </tr>
                                                <!--upload assignment model-->
                                                <div class="modal fade" id="uploadAns<?php echo $assf['assignment_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Upload Assignment</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row mt-3">
                                                                    <div class="col-12">
                                                                        <div id="alertBox" class="">
                                                                            <i id="signBox" class=""></i>
                                                                            <div id="textBox" class="ms-3"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <label class="form-label">Assignment Name</label>
                                                                        <input class="form-control" disabled value="<?php echo $assf["assignment_name"] ?>">
                                                                    </div>
                                                                    <div class="col-12 mt-3">
                                                                        <label class="form-label">Student Full Name</label>
                                                                        <input class="form-control" disabled value="<?php echo $_SESSION["student"]["first_name"] . " " . $_SESSION["student"]["last_name"] ?>">
                                                                    </div>
                                                                    <div class="col-12 mt-3">
                                                                        <label class="form-label">Subject</label>
                                                                        <input class="form-control" disabled value="<?php echo $af["subject_name"] ?>">
                                                                    </div>
                                                                    <div class="col-12 mt-3">
                                                                        <label class="form-label">Upload your Answers(PDF only)</label>
                                                                        <input type="file" id="ansFile<?php echo $assf["assignment_id"] ?>" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="button" class="btn btn-success" onclick="uploadAnswers(<?php echo $assf['assignment_id'] ?>)">Upload</button>
                                                                <!--send the assignment id as a parameter to identify the assignment-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }

                                        ?>



                                    <?php
                                    }

                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </section>




        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    </body>


    </html>
<?php
} else { //else, if no student session
?>
    <script>
        window.location = "index.php"; //returns to index
    </script>
<?php
}
