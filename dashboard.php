<?php
session_start();
require "connection/connection.php";

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

</head>

<body>


    <?php
    require "./components/aside.php";

    ?>
    <section class="home-section">
        <?php
        require "./components/header.php";
        ?>
        <div class="row">
            <div class="col-10 offset-1">
                <div class="card pt-3 p-5 mt-3">
                    <?php


                    if (isset($_SESSION["admin"])) { //if session is admin
                    ?>
                        <div class="row mt-3">
                            <div class="col-12 mb-2">
                                <h4 class="text-black-50">Summary</h1>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-4 mt-3 mt-lg-0">
                                        <div class="s-box-p p-4">
                                            <div class="row">
                                                <div class="col-4 d-flex justify-content-center">
                                                    <span><i class="bi bi-people-fill fs-1"></i></span>
                                                </div>
                                                <div class="col-8 d-flex align-items-center">
                                                    <span class="fs-6"><?php
                                                                        //display number of students
                                                                        $ns = Database::select("SELECT * FROM `student`");
                                                                        $nsn = $ns->num_rows;
                                                                        ?>
                                                        <strong><?php echo $nsn ?></strong>
                                                        <?php

                                                        ?> New Students</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-4 mt-3 mt-lg-0">
                                        <div class="s-box-b p-4">
                                            <div class="row">
                                                <div class="col-4 d-flex justify-content-center">
                                                    <span><i class="bi bi-people-fill fs-1"></i></span>
                                                </div>
                                                <div class="col-8 d-flex align-items-center">
                                                    <span class="fs-6"><?php
                                                                        //display number of teachers
                                                                        $ns = Database::select("SELECT * FROM `teacher`");
                                                                        $nsn = $ns->num_rows;
                                                                        ?>
                                                        <strong><?php echo $nsn ?></strong>
                                                        <?php

                                                        ?> New Teachers</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4 mt-3 mt-lg-0">
                                        <div class="s-box-o p-4">
                                            <div class="row">
                                                <div class="col-4 d-flex justify-content-center">
                                                    <span><i class="bi bi-people-fill fs-1"></i></span>
                                                </div>
                                                <div class="col-8 d-flex align-items-center">
                                                    <span class="fs-6"><?php
                                                                        //display number of academic officers
                                                                        $ns = Database::select("SELECT * FROM `acedamic`");
                                                                        $nsn = $ns->num_rows;
                                                                        ?>
                                                        <strong><?php echo $nsn ?></strong>
                                                        <?php

                                                        ?> New Academic Officers</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <h4 class="text-black-50">New Students</h1>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="table-responsive">
                                    <table class="table table-bordered mt-3 table-responsive">
                                        <tr class="fw-bold">
                                            <td>Student_id</td>
                                            <td>Full Name</td>
                                            <td>Username</td>
                                            <td>Email</td>
                                            <td>Grade</td>
                                            <td>Account Status</td>


                                        </tr>
                                        <?php
                                        //selecting all students limited to 5
                                        $r = Database::select("SELECT * FROM `student`  ORDER BY `student_id` DESC LIMIT 5");
                                        $n = $r->num_rows;
                                        if ($n > 0) {
                                            for ($i = 0; $i < $n; $i++) { //loop through rows
                                                $d = $r->fetch_assoc(); //assoc arrays
                                        ?>
                                                <tr>
                                                    <td><?php echo $d["student_id"] ?></td>
                                                    <td><?php echo $d["first_name"] . " " . $d["last_name"] ?></td>
                                                    <td><?php echo $d["user_name"] ?></td>
                                                    <td><?php echo $d["email"] ?></td>
                                                    <td>
                                                        <?php
                                                        //seacher the grade by grade_id from the student row
                                                        $gr = Database::select("SELECT * FROM `grade` WHERE `grade_id`='" . $d["grade_id"] . "'");
                                                        $grf = $gr->fetch_assoc();
                                                        ?>
                                                        Grade <?php echo $grf["grade_name"] ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($d["status"] = 1) { //if the student status 1 means he is a older user verified
                                                        ?>
                                                            <span class="badge rounded-pill alert-success">Verified</span>
                                                        <?php
                                                        } else { //if the student status 0 means he is a new user has notsign in yet with system  not verified
                                                        ?>
                                                            <span class="badge rounded-pill alert-danger">Not Verified</span>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>



                                                </tr>
                                        <?php
                                            }
                                        } else { //if n students available
                                            echo "no students available";
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <h4 class="text-black-50">New Teachers</h1>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="table-responsive">
                                    <table class="table table-bordered mt-3 table-responsive">
                                        <tr class="fw-bold">
                                            <td>Teacher Id</td>
                                            <td>Full Name</td>
                                            <td>Username</td>
                                            <td>Email</td>
                                            <td>Account Status</td>


                                        </tr>
                                        <?php
                                        //selecting all teacher limited to 5
                                        $r = Database::select("SELECT * FROM `teacher`  ORDER BY `teacher_id` DESC LIMIT 5");
                                        $n = $r->num_rows;
                                        if ($n > 0) {
                                            for ($i = 0; $i < $n; $i++) { //loop through rows
                                                $d = $r->fetch_assoc();
                                        ?>
                                                <tr>
                                                    <td><?php echo $d["teacher_id"] ?></td>
                                                    <td><?php echo $d["first_name"] . " " . $d["last_name"] ?></td>
                                                    <td><?php echo $d["user_name"] ?></td>
                                                    <td><?php echo $d["email"] ?></td>

                                                    <td>
                                                        <?php
                                                        if ($d["status"] = 1) { //if the teacher status 1 means he is a older user verified
                                                        ?>
                                                            <span class="badge rounded-pill alert-success">Verified</span>
                                                        <?php
                                                        } else { //if the teacher status 0 means he is a new user has notsign in yet with system  not verified
                                                        ?>
                                                            <span class="badge rounded-pill alert-danger">Not Verified</span>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>



                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "no Officers available";
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <h4 class="text-black-50">New Acedamic Officer</h1>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="table-responsive">
                                    <table class="table table-bordered mt-3 table-responsive">
                                        <tr class="fw-bold">
                                            <td>Acedamic Id</td>
                                            <td>Full Name</td>
                                            <td>Username</td>
                                            <td>Email</td>
                                            <td>Account Status</td>


                                        </tr>
                                        <?php
                                        //selecting all teacher limited to 5
                                        $r = Database::select("SELECT * FROM `acedamic`  ORDER BY `acedamic_id` DESC LIMIT 5");
                                        $n = $r->num_rows;
                                        if ($n > 0) {
                                            for ($i = 0; $i < $n; $i++) {
                                                $d = $r->fetch_assoc();
                                        ?>
                                                <tr>
                                                    <td><?php echo $d["acedamic_id"] ?></td>
                                                    <td><?php echo $d["first_name"] . " " . $d["last_name"] ?></td>
                                                    <td><?php echo $d["user_name"] ?></td>
                                                    <td><?php echo $d["email"] ?></td>

                                                    <td>
                                                        <?php
                                                        if ($d["status"] = 1) { //if the academic status 1 means he is a older user verified
                                                        ?>
                                                            <span class="badge rounded-pill alert-success">Verified</span>
                                                        <?php
                                                        } else { //if the academic officer status 0 means he is a new user has notsign in yet with system  not verified
                                                        ?>
                                                            <span class="badge rounded-pill alert-danger">Not Verified</span>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>



                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "no Officers available";
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <h4 class="text-black-50">Subject Combinations</h1>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="table-responsive">
                                    <table class="table table-bordered mt-3 ">
                                        <tr class="fw-bold">
                                            <td>Teacher Id</td>
                                            <td>Teacher Name</td>
                                            <td>Grade</td>
                                            <td>Subject</td>



                                        </tr>
                                        <?php
                                        //get rows from teacher_has_grade_has_subject where has all the information about teacher subject combinations
                                        $r = Database::select("SELECT * FROM `teacher_has_grade_has_subject` ORDER BY `id` DESC LIMIT 5");
                                        $n = $r->num_rows;
                                        if ($n > 0) {
                                            for ($i = 0; $i < $n; $i++) {
                                                $d = $r->fetch_assoc();
                                        ?>
                                                <tr>
                                                    <td><?php
                                                        //search for teacher by teacher id from teacher_has_grade_has_subject
                                                        $t = Database::select("SELECT * FROM `teacher` WHERE `teacher_id`='" . $d["teacher_id"] . "'");
                                                        $tr = $t->fetch_assoc();
                                                        echo $tr["teacher_id"];
                                                        ?></td>
                                                    <td><?php echo $tr["first_name"] . " " . $tr["last_name"] ?></td>
                                                    <td><?php
                                                        //search for grade by grade id from teacher_has_grade_has_subject
                                                        $grade = Database::select("SELECT * FROM `grade` WHERE `grade_id`='" . $d["grade_id"] . "'");
                                                        $gr = $grade->fetch_assoc();
                                                        ?>Grade <?php echo $gr["grade_name"];
                                                                ?></td>
                                                    <td><?php
                                                        //search for subject by subject id from teacher_has_grade_has_subject
                                                        $subject = Database::select("SELECT * FROM `subject` WHERE `subject_id`='" . $d["subject_id"] . "'");
                                                        $sr = $subject->fetch_assoc();
                                                        echo $sr["subject_name"];
                                                        ?></td>

                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "no subject combinations available";
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>

                    <?php
                    } else if (isset($_SESSION["teacher"])) { // if session is teacher

                    ?>
                        <div class="row mt-3">
                            <div class="col-12 mb-3">
                                <h4 class="text-black-50">New Alerts</h1>
                            </div>
                            <?php
                            //searching for teacher subject combinations and remind about combinations to the teacher every time the page loads
                            $thghs = Database::select("SELECT * FROM `teacher_has_grade_has_subject` INNER JOIN `subject` ON `teacher_has_grade_has_subject`.`subject_id`=`subject`.`subject_id` INNER JOIN
                                                         `grade` ON `teacher_has_grade_has_subject`.`grade_id`=`grade`.`grade_id` WHERE `teacher_id`='" . $_SESSION["teacher"]["teacher_id"] . "';");
                            $thghsn = $thghs->num_rows;

                            if ($thghsn > 0) {
                                for ($t = 0; $t < $thghsn; $t++) {
                                    $thghsr = $thghs->fetch_assoc(); //loops through rows and display them on alerts
                            ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>Dear Teacher!</strong> The admin has appointed you as the teacher for <strong>grade <?php echo $thghsr["grade_name"] . " " . $thghsr["subject_name"] ?> </strong>.
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>

                            <div class="col-12">
                                <h4 class="text-black-50">Latest Lesson Notes</h1>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr class="fw-bold">
                                            <td>Added Date</td>
                                            <td>Subject</td>
                                            <td>Grade</td>
                                            <td>Description</td>
                                            <td>Action</td>
                                        </tr>
                                        <?php
                                        //search for combinations of the teacher
                                        $idr = Database::select("SELECT * FROM `teacher_has_grade_has_subject` WHERE `teacher_id`='" . $_SESSION['teacher']['teacher_id'] . "'");
                                        $idn = $idr->num_rows;

                                        if ($idn > 0) {
                                            for ($i = 0; $i < $idn; $i++) { //loop through rows
                                                $idf = $idr->fetch_assoc(); //assoc arrays
                                                $lesson = Database::select("SELECT * FROM `lesson_notes` WHERE `teacher_has_grade_has_subject_id`='" . $idf["id"] . "' LIMIT 5");
                                                $lessonno = $lesson->num_rows;
                                                if ($lessonno > 0) {//if teacher has uploaded lesson notes

                                                    for ($z = 0; $z < $lessonno; $z++) {//loop through rows
                                                        $lessonr = $lesson->fetch_assoc(); //assoc arrays
                                        ?>
                                                        <tr>
                                                            <td><?php
                                                                $datee = $lessonr["added_date"];
                                                                $splitdt = explode(" ", $datee);//explode function will break the string to array
                                                                echo $splitdt[0];//0 index of the array is the date
                                                                ?></td>
                                                            <td>
                                                                <?php
                                                                //select subject name
                                                                $s = Database::select("SELECT * FROM `subject` WHERE `subject_id`='" . $idf["subject_id"] . "'");
                                                                $sf = $s->fetch_assoc();
                                                                echo $sf["subject_name"];
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                //select grade name
                                                                $g = Database::select("SELECT * FROM `grade` WHERE `grade_id`='" . $idf["grade_id"] . "'");
                                                                $gf = $g->fetch_assoc();
                                                                ?>Grade <?php echo $gf["grade_name"];
                                                                        ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $lessonr["description"] ?>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-light border border-secondary" href="tasks/downloadLessonsProcess.php?file=<?php echo $lessonr["lesson_file"] ?>" class="btn <?php echo $classbtn[$z] ?> btn-sm">Download</a>
                                                            </td>
                                                        </tr>
                                        <?php
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-12">
                                <h4 class="text-black-50">Latest Assignments</h1>
                            </div>
                            <div class="col-12 mt-3">
                                <table class="table table-bordered">
                                    <tr class="fw-bold">
                                        <td>Assignment name</td>
                                        <td>Added Date</td>
                                        <td>End Date</td>
                                        <td>Subject</td>
                                        <td>Grade</td>

                                    </tr>
                                    <?php
                                    $asdr = Database::select("SELECT * FROM `teacher_has_grade_has_subject` WHERE `teacher_id`='" . $_SESSION['teacher']['teacher_id'] . "'");
                                    $asdn = $idr->num_rows;

                                    if ($asdn > 0) {
                                        for ($i = 0; $i < $asdn; $i++) {
                                            $asdf = $asdr->fetch_assoc();
                                            $ass = Database::select("SELECT * FROM `assignment` WHERE `teacher_has_grade_has_subject_id`='" . $idf["id"] . "' LIMIT 5");
                                            $assn = $ass->num_rows;
                                            if ($assn > 0) {

                                                for ($z = 0; $z < $assn; $z++) {
                                                    $assr = $ass->fetch_assoc();
                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $assr["assignment_name"] ?>
                                                        </td>
                                                        <td><?php
                                                            $datee = $assr["added_date"];
                                                            $splitdt = explode(" ", $datee);
                                                            echo $splitdt[0];
                                                            ?></td>
                                                        <td>
                                                            <?php
                                                            $datee2 = $assr["dead_line"];
                                                            $splitdt2 = explode(" ", $datee2);
                                                            echo $splitdt2[0];
                                                            ?></td>
                                                        <td>
                                                            <?php
                                                            $s = Database::select("SELECT * FROM `subject` WHERE `subject_id`='" . $asdf["subject_id"] . "'");
                                                            $sf = $s->fetch_assoc();
                                                            echo $sf["subject_name"];
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $g = Database::select("SELECT * FROM `grade` WHERE `grade_id`='" . $asdf["grade_id"] . "'");
                                                            $gf = $g->fetch_assoc();
                                                            ?>Grade <?php echo $gf["grade_name"];
                                                                    ?>
                                                        </td>

                                                    </tr>
                                    <?php
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>

                    <?php
                    } else if (isset($_SESSION["officer"])) {//if the session is academic officer no dashboard for academic account redirecing to the settings page
                    ?>
                        <script>
                            window.location = "settings.php"
                        </script>
                    <?php

                    } else if (isset($_SESSION["student"])) {//if the session is student
                    ?>
                        <div class="row mt-3">
                            <?php
                            $fee = $_SESSION["student"]["fee_paid"];
                            if ($fee == '0') {
                            ?>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-4 offset-8">
                                            <div class="alert alert-danger border border-1 border-danger">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <span><i class="bi bi-alarm-fill fs-2"></i></span>
                                                    </div>
                                                    <div class="col-10">
                                                        <span>You have
                                                            <strong>
                                                                <?php
                                                                // finding reminding days of the free trial
                                                                $added_date = $_SESSION["student"]["register_date"];
                                                                $sdate = new DateTime($added_date);//convert to datetime
                                                                $d = new DateTime();//curent datetime
                                                                $tz = new DateTimeZone("Asia/Colombo");
                                                                $d->setTimeZone($tz);
                                                                $endDate = new DateTime($d->format("Y-m-d H:i:s"));//format
                                                                $interval = $endDate->diff($sdate);//diff function to get the difference ibetween days
                                                                $days =  $interval->format('%d');//in days
                                                                $rdays = 30 - $days;//looking for the reminding days
                                                                echo $rdays;
                                                                ?></strong>
                                                            days left on your free trial.</span>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                            <div class="col-12">
                                <h4 class="text-black-50">Latest Lesson Notes</h1>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr class="fw-bold">
                                            <td>Added Date</td>
                                            <td>Subject</td>
                                            <td>Grade</td>
                                            <td>Description</td>
                                            <td>Action</td>
                                        </tr>
                                        <?php
                                        //searching lesson notes iby student grade 
                                        $idr = Database::select("SELECT * FROM `teacher_has_grade_has_subject` WHERE `grade_id`='" . $_SESSION['student']['grade_id'] . "'");
                                        $idn = $idr->num_rows;

                                        if ($idn > 0) {
                                            for ($i = 0; $i < $idn; $i++) {
                                                $idf = $idr->fetch_assoc();
                                                $lesson = Database::select("SELECT * FROM `lesson_notes` WHERE `teacher_has_grade_has_subject_id`='" . $idf["id"] . "' LIMIT 5");
                                                $lessonno = $lesson->num_rows;
                                                if ($lessonno > 0) {

                                                    for ($z = 0; $z < $lessonno; $z++) {
                                                        $lessonr = $lesson->fetch_assoc();
                                        ?>
                                                        <tr>
                                                            <td><?php
                                                                $datee = $lessonr["added_date"];
                                                                $splitdt = explode(" ", $datee);
                                                                echo $splitdt[0];
                                                                ?></td>
                                                            <td>
                                                                <?php
                                                                $s = Database::select("SELECT * FROM `subject` WHERE `subject_id`='" . $idf["subject_id"] . "'");
                                                                $sf = $s->fetch_assoc();
                                                                echo $sf["subject_name"];
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $g = Database::select("SELECT * FROM `grade` WHERE `grade_id`='" . $idf["grade_id"] . "'");
                                                                $gf = $g->fetch_assoc();
                                                                ?>Grade <?php echo $gf["grade_name"];
                                                                        ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $lessonr["description"] ?>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-light border border-secondary" href="tasks/downloadLessonsProcess.php?file=<?php echo $lessonr["lesson_file"] ?>" class="btn <?php echo $classbtn[$z] ?> btn-sm">Download</a>
                                                            </td>
                                                        </tr>
                                        <?php
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-12">
                                <h4 class="text-black-50">Latest Assignments</h1>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr class="fw-bold">
                                            <td>Assignment name</td>
                                            <td>Added Date</td>
                                            <td>End Date</td>
                                            <td>Subject</td>
                                            <td>Grade</td>

                                        </tr>
                                        <?php
                                        $asdr = Database::select("SELECT * FROM `teacher_has_grade_has_subject` WHERE `grade_id`='" . $_SESSION['student']['grade_id'] . "'");
                                        $asdn = $idr->num_rows;

                                        if ($asdn > 0) {
                                            for ($i = 0; $i < $asdn; $i++) {
                                                $asdf = $asdr->fetch_assoc();
                                                $ass = Database::select("SELECT * FROM `assignment` WHERE `teacher_has_grade_has_subject_id`='" . $idf["id"] . "' LIMIT 5");
                                                $assn = $ass->num_rows;
                                                if ($assn > 0) {

                                                    for ($z = 0; $z < $assn; $z++) {
                                                        $assr = $ass->fetch_assoc();
                                        ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $assr["assignment_name"] ?>
                                                            </td>
                                                            <td><?php
                                                                $datee = $assr["added_date"];
                                                                $splitdt = explode(" ", $datee);
                                                                echo $splitdt[0];
                                                                ?></td>
                                                            <td>
                                                                <?php
                                                                $datee2 = $assr["dead_line"];
                                                                $splitdt2 = explode(" ", $datee2);
                                                                echo $splitdt2[0];
                                                                ?></td>
                                                            <td>
                                                                <?php
                                                                $s = Database::select("SELECT * FROM `subject` WHERE `subject_id`='" . $asdf["subject_id"] . "'");
                                                                $sf = $s->fetch_assoc();
                                                                echo $sf["subject_name"];
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $g = Database::select("SELECT * FROM `grade` WHERE `grade_id`='" . $asdf["grade_id"] . "'");
                                                                $gf = $g->fetch_assoc();
                                                                ?>Grade <?php echo $gf["grade_name"];
                                                                        ?>
                                                            </td>

                                                        </tr>
                                        <?php
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <script>
                            window.location = "index.php";
                        </script>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>


    </section>




    <script src="script.js"></script>
    <!-- <script src="bootstrap.js"></script> -->
    <script src="bootstrap.bundle.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
</body>

</html>