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
    <link rel="icon" href="Resources/icons8-settings-64.png">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>

</head>

<body>
    <?php
    require "components/aside.php";

    if (isset($_SESSION["admin"])) { // if the session is admin this content will be displayed
    ?>
        <section class="home-section">
            <div class="row ">
                <div class="col-10 offset-1 card mt-5 p-5">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <img src="./Resources/user.png" width="100" height="auto">
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <h4 class="fw-bolder">Admin User</h4>
                        </div>

                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-6">
                            <div class="row ">
                                <div class="col-12 mt-3">
                                    <label for="" class="form-label">Admin Name:</label>
                                    <input type="text" class="form-control" value="<?php echo $_SESSION["admin"]["admin_name"] ?>">
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="" class="form-label">Registered Date:</label>
                                    <input type="text" class="form-control" disabled value="<?php echo $_SESSION["admin"]["register_date"] ?>">
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="" class="form-label">Password:</label>
                                    <input type="password" class="form-control" disabled value="<?php echo $_SESSION["admin"]["admin_password"] ?>">
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </section>

    <?php
    } else if (isset($_SESSION["teacher"])) { // if the session is teacher this content will be displayed
    ?>

        <section class="home-section">
            <div class="row ">
                <div class="col-10 offset-1 card mt-5 p-5">
                    <div class="row">

                        <div class="col-12 d-flex justify-content-center">
                            <img src="./Resources/user.png" width="100" height="auto">
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <h4 class="fw-bolder">Teacher</h4>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <?php
                            if ($_SESSION["teacher"]["account_status"] == '1') { // check the teacher status
                            ?>
                                <span class="badge rounded-pill alert-success">Verified User</span>
                            <?php
                            } else {
                            ?>
                                <span class="badge rounded-pill alert-danger">UnVerified User</span>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-12">
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div id="alertBox" class="d-none">
                                        <i id="signBox" class=""></i>
                                        <!-- message box -->
                                        <div id="textBox" class="ms-3"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-12 mt-3">
                                    <label for="" class="form-label">Teacher Id:</label>
                                    <input type="text" class="form-control" disabled value="<?php echo $_SESSION["teacher"]["teacher_id"] ?>">
                                </div>
                                <div class="col-6 mt-3">
                                    <label for="" class="form-label">First Name:</label>
                                    <input type="text" id="tfn" class="form-control" value="<?php echo $_SESSION["teacher"]["first_name"] ?>">
                                </div>
                                <div class="col-6 mt-3">
                                    <label for="" class="form-label">Last Name:</label>
                                    <input type="text" id="tln" class="form-control" value="<?php echo  $_SESSION["teacher"]["last_name"] ?>">
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-6 mt-3">
                                    <label for="" class="form-label">Email Address:</label>
                                    <input type="text" disabled class="form-control" value="<?php echo $_SESSION["teacher"]["email"] ?>">
                                </div>
                                <div class="col-6 mt-3">
                                    <label for="" class="form-label">User Name:</label>
                                    <input type="text" id="tun" class="form-control" value="<?php echo $_SESSION["teacher"]["user_name"] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mt-3">
                                    <label for="" class="form-label">Register Date & Time:</label>
                                    <input type="text" disabled class="form-control" value="<?php echo $_SESSION["teacher"]["register_date"] ?>">
                                </div>
                                <div class="col-6 mt-3">
                                    <label class="form-label">Gender:</label>

                                    <?php
                                    //select all genders
                                    $g = Database::select("SELECT * FROM `gender` WHERE `gender_id`='" . $_SESSION["teacher"]["gender_id"] . "'");
                                    $gn = $g->num_rows;
                                    if ($gn == 1) {
                                        $gf = $g->fetch_assoc();
                                    ?>
                                        <input type="text" disabled class="form-control" value="<?php echo $gf["gender_name"] ?>">
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="" class="form-label">Password:</label>


                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <input type="password" disabled class="form-control" value="<?php echo $_SESSION["teacher"]["password"] ?>">
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-secondary" onclick="openPasswordModel()">Change password</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-grid mt-4">
                            <button class="btn btn-success" onclick="updateTeacher('<?php echo $_SESSION['teacher']['teacher_id'] ?>')">Update Profile</button>
                        </div>
                    </div>

                </div>


            </div>

        </section>



    <?php
    } else if (isset($_SESSION["officer"])) { // if the session is officer this content will be displayed
    ?>

        <section class="home-section">
            <div class="row ">
                <div class="col-10 offset-1 card mt-5 p-5">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <img src="./Resources/user.png" width="100" height="auto">
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <h4 class="fw-bolder">Acedamic Officer</h4>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <?php
                            if ($_SESSION["officer"]["account_status"] == '1') { // check whether the officer status verified or unverified
                            ?>
                                <span class="badge rounded-pill alert-success">Verified User</span>
                            <?php
                            } else {
                            ?>
                                <span class="badge rounded-pill alert-danger">Un Verified User</span>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-12">
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div id="alertBox" class="d-none">
                                        <i id="signBox" class=""></i>
                                        <div id="textBox" class="ms-3"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-12 mt-3">
                                    <label for="" class="form-label">Acedamic Officer Id:</label>
                                    <input type="text" class="form-control" disabled value="<?php echo $_SESSION["officer"]["acedamic_id"] ?>">
                                </div>
                                <div class="col-6 mt-3">
                                    <label for="" class="form-label">First Name:</label>
                                    <input type="text" id="afn" class="form-control" value="<?php echo $_SESSION["officer"]["first_name"]  ?>">
                                </div>
                                <div class="col-6 mt-3">
                                    <label for="" class="form-label">Last Name:</label>
                                    <input type="text" id="aln" class="form-control" value="<?php echo  $_SESSION["officer"]["last_name"] ?>">
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-12 mt-3">
                                    <label for="" class="form-label">Email Address:</label>
                                    <input type="text" disabled class="form-control" value="<?php echo $_SESSION["officer"]["email"] ?>">
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="" class="form-label">User Name:</label>
                                    <input type="text" id="aun" class="form-control" value="<?php echo $_SESSION["officer"]["user_name"] ?>">
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-6 mt-3">
                                    <label for="" class="form-label">Register Date & Time:</label>
                                    <input type="text" disabled class="form-control" value="<?php echo $_SESSION["officer"]["register_date"] ?>">
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="" class="form-label">Password:</label>


                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <input type="password" disabled class="form-control" value="<?php echo $_SESSION["officer"]["password"] ?>">
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-secondary" onclick="openPasswordModel()">Change password</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-grid mt-4">
                            <button class="btn btn-success" onclick="updateOfficer('<?php echo $_SESSION['officer']['acedamic_id'] ?>')">Update Profile</button>
                        </div>
                    </div>

                </div>


            </div>

        </section>



    <?php
    } else if (isset($_SESSION["student"])) { // if the session is student this content will be displayed
    ?>
        <section class="home-section">
            <div class="row ">
                <div class="col-10 offset-1 card mt-5 p-5">
                    <div class="row">
                        <?php
                        $fee = $_SESSION["student"]["fee_paid"];

                        if ($fee == '0') {
                            // if the student still in the trial period this will be displayed
                        ?>
                            <div class="col-4 offset-4 d-flex justify-content-center">
                                <img src="./Resources/user.png" width="100" height="auto">
                            </div>
                            <div class="col-4">
                                <div class="alert alert-danger border border-1 border-danger">
                                    <div class="row">
                                        <div class="col-2">
                                            <span><i class="bi bi-alarm-fill fs-2"></i></span>
                                        </div>
                                        <!-- alert box for indicate trail period or due payment -->
                                        <div class="col-10">
                                            <span>You have
                                                <strong>
                                                    <?php
                                                    $added_date = $_SESSION["student"]["register_date"]; //register date of the student
                                                    $sdate = new DateTime($added_date); // convert the string to datetime object
                                                    $d = new DateTime(); // cresting a new datetime obejct
                                                    $tz = new DateTimeZone("Asia/Colombo"); //set time zone
                                                    $d->setTimeZone($tz);
                                                    $endDate = new DateTime($d->format("Y-m-d H:i:s"));
                                                    $interval = $endDate->diff($sdate); //get the difference from the register date to current date
                                                    $days =  $interval->format('%d');
                                                    $rdays = 30 - $days;
                                                    echo $rdays;
                                                    ?></strong>
                                                days left on your free trial.</span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="col-12 d-flex justify-content-center">
                                <img src="./Resources/user.png" width="100" height="auto">
                            </div>
                        <?php
                        }
                        ?>

                        <div class="col-12 d-flex justify-content-center">
                            <h4 class="fw-bolder">Student Account</h4>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <?php
                            if ($_SESSION["student"]["account_status"] == '1') { // check whether the officer status verified or unverified
                            ?>
                                <span class="badge rounded-pill alert-success">Verified Student</span>
                            <?php
                            } else {
                            ?>
                                <span class="badge rounded-pill alert-danger">Un Verified Student</span>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-12">
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div id="alertBox" class="d-none">
                                        <i id="signBox" class=""></i>
                                        <div id="textBox" class="ms-3"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row ">

                                <div class="col-6 mt-3">
                                    <label for="" class="form-label">First Name:</label>
                                    <input type="text" id="sfn" class="form-control" value="<?php echo $_SESSION["student"]["first_name"] ?>">
                                </div>
                                <div class="col-6 mt-3">
                                    <label for="" class="form-label">Last Name:</label>
                                    <input type="text" id="sln" class="form-control" value="<?php echo  $_SESSION["student"]["last_name"] ?>">
                                </div>

                                <div class="col-6 mt-3">
                                    <label for="" class="form-label">Email Address:</label>
                                    <input type="text" disabled class="form-control" value="<?php echo $_SESSION["student"]["email"] ?>">
                                </div>
                                <div class="col-6 mt-3">
                                    <label for="" class="form-label">User Name:</label>
                                    <input type="text" id="sun" class="form-control" value="<?php echo $_SESSION["student"]["user_name"] ?>">
                                </div>
                                <div class="col-6 mt-3">
                                    <label for="" class="form-label">Register Date & Time:</label>
                                    <input type="text" disabled class="form-control" value="<?php echo $_SESSION["student"]["register_date"] ?>">
                                </div>
                                <div class="col-6 mt-3">
                                    <label for="" class="form-label">Birth Date:</label>
                                    <input type="text" disabled class="form-control" value="<?php echo $_SESSION["student"]["b_date"] ?>">
                                </div>
                                <div class="col-6 mt-3">
                                    <label for="" class="form-label">Gender:</label>
                                    <?php
                                    $g = Database::select("SELECT * FROM `gender` WHERE `gender_id`='" . $_SESSION["student"]["gender_id"] . "'");
                                    $gn = $g->num_rows;
                                    if ($gn == 1) {
                                        $gf = $g->fetch_assoc();
                                    ?>
                                        <input type="text" disabled class="form-control" value="<?php echo $gf["gender_name"] ?>">
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-6 mt-3">
                                    <label for="" class="form-label">Grade:</label>
                                    <?php
                                    $gr = Database::select("SELECT * FROM `grade` WHERE `grade_id`='" . $_SESSION["student"]["grade_id"] . "'");
                                    $grn = $g->num_rows;
                                    if ($grn == 1) {
                                        $grf = $gr->fetch_assoc();
                                    ?>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Grade</span>
                                            <input type="text" disabled class="form-control" value="<?php echo $grf["grade_name"] ?>">
                                        </div>

                                    <?php
                                    }
                                    ?>
                                </div>


                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="" class="form-label">Password:</label>


                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <input type="password" disabled class="form-control" value="<?php echo $_SESSION["student"]["password"] ?>">
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-secondary" onclick="openPasswordModel()">Change password</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-grid mt-4">
                            <button class="btn btn-success" onclick="updateStudent(<?php echo $_SESSION['student']['student_id'] ?>)">Update Profile</button>

                        </div>
                    </div>

                </div>


            </div>

        </section>




    <?php
    }


    ?>
    <div class="modal fade" id="studentpasswordModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div id="mBox" class="d-none">
                                <i id="sBox" class=""></i>
                                <div id="tBox" class="ms-3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <label class="form-label">Verification Code</label>
                            <input type="text" id="c" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">New password</label>
                            <input type="password" id="nw" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Confirm password</label>
                            <input type="password" id="cw" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="changepassword()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
</body>

</html>