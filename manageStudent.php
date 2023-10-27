<?php
session_start();
require "connection/connection.php";
if (isset($_SESSION["admin"])) { //check the session for admin session
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
        <title>Admin | Manage Students</title>

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
                <div class="col-12 ">
                    <div class="card bg-light p-3">
                        <div class="row mt-2">
                            <div class="col-12">
                                <h4 class="text-black-50">Student List</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" style="height: 500px;">
                                    <!--table that display student details-->
                                    <table class="table mt-3">
                                        <tr class="fw-bold">
                                            <td>Student_id</td>
                                            <td>Full Name</td>
                                            <td>Username</td>
                                            <td>Grade</td>
                                            <td>Account Status</td>
                                            <td>Action</td>

                                        </tr>
                                        <?php
                                        $r = Database::select("SELECT * FROM `student`"); //search complete student table
                                        $n = $r->num_rows; //find number of rows in full student table

                                        if ($n > 0) { //goes in only number of rows are more than 0
                                            for ($i = 0; $i < $n; $i++) { //loop through rows
                                                $d = $r->fetch_assoc(); //put row in to an associative array
                                                //display details from associative array
                                        ?>
                                                <tr>
                                                    <td><?php echo $d["student_id"] ?></td>
                                                    <td><?php echo $d["first_name"] . " " . $d["last_name"] ?></td>
                                                    <td><?php echo $d["user_name"] ?></td>
                                                    <td>
                                                        <?php
                                                        $gr = Database::select("SELECT * FROM `grade` WHERE `grade_id`='" . $d["grade_id"] . "'"); //search from grade with the student grade_id
                                                        $grf = $gr->fetch_assoc(); //surely an resultset will be available. no need to chck with a if. and will have one grade
                                                        ?>
                                                        <span onclick="updateGModel('<?php echo $d['student_id'] ?>')">Grade <?php echo $grf["grade_name"] ?> <i class="bi bi-pencil-square text-dark"></i></span>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($d["account_status"] = 1) { //if works only if the account status of the student is 1. which is a verified user
                                                        ?>
                                                            <span class="badge rounded-pill alert-success">Verified</span>
                                                        <?php
                                                        } else { //if status is 0, an user whose yet to login to the system
                                                        ?>
                                                            <span class="badge rounded-pill alert-danger">Not Verified</span>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        //if student has no payments to do this will be 1. 
                                                        if ($d["fee_paid"] == '1') {
                                                        ?>
                                                            <span  role="button" class="badge rounded-pill alert-success">Paid</span>
                                                        <?php
                                                        } else {
                                                            //admin can click this to change the status to 1. due payment beadge means either the students free trial is over or end of an academic year for the student
                                                        ?>
                                                            <span  role="button" onclick="paymentStatus(<?php echo $d['student_id'] ?>)" class="badge rounded-pill alert-danger">Due Payment</span>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>

                                                    <td>
                                                        <?php
                                                        if ($d["status_id"] == "1") { //if works only if student account active.admin can block account by clicking
                                                        ?>
                                                            <span  role="button" class="badge rounded-pill alert-success" onclick="StudentStatusModel('<?php echo $d['student_id'] ?>')">Block Student</span>
                                                        <?php
                                                        } else { //display only if student account inactive. 
                                                        ?>
                                                            <span  role="button" class="badge rounded-pill alert-danger" onclick="StudentStatusModel('<?php echo $d['student_id'] ?>')">Unblock Student</span>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>

                                                    <td>
                                                        <!--button will open up the model diplaying all the student details-->
                                                        <button onclick="displayStudentDetails('<?php echo $d['student_id'] ?>')" class="btn btn-light border-1 border-secondary">
                                                            View
                                                        </button>
                                                    </td>


                                                </tr>
                                                <!--this model displays student details-->
                                                <div class="modal fade" id="displayStudentDetails<?php echo $d['student_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel"><?php echo $d["first_name"] . " " . $d["last_name"] ?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col-12">
                                                                    <div class="row gy-3">
                                                                        <div class="col-12">
                                                                            <!--can take the data from assoc because we are in the same block-->
                                                                            <span>Account Type : <strong>Student</strong></span>
                                                                        </div>
                                                                        <div class="col-12 col-md-6">
                                                                            <span>Student Id : <strong><?php echo $d["student_id"] ?></strong></span>
                                                                        </div>
                                                                        <div class="col-12 col-md-6">
                                                                            <span>Full Name : <strong><?php echo $d["first_name"] . " " . $d["last_name"] ?></strong></span>
                                                                        </div>
                                                                        <div class="col-12 col-md-4">
                                                                            <span>Birth Date : <strong><?php echo $d["b_date"] ?></strong></span>
                                                                        </div>
                                                                        <div class="col-12 col-md-4">
                                                                            <span>Age :
                                                                                <strong>
                                                                                    <?php
                                                                                    //finding the age of the students
                                                                                    $b_date = $d["b_date"]; //get the birth day from the assoc array
                                                                                    $sdate = new DateTime($b_date); //get to the format
                                                                                    $c = new DateTime(); //get the current time
                                                                                    $tz = new DateTimeZone("Asia/Colombo"); //get the time zone
                                                                                    $c->setTimeZone($tz);
                                                                                    $toDate = new DateTime($c->format("Y-m-d H:i:s")); //get format
                                                                                    $interval = $toDate->diff($sdate); //use diff function to find the diffrence between bdate and today
                                                                                    $years =  $interval->format('%Y'); //only needs age in years
                                                                                    echo $years;
                                                                                    ?></strong>
                                                                            </span>
                                                                        </div>
                                                                        <div class="col-12 col-md-4">
                                                                            <span>Grade : <strong><?php
                                                                                                    $grade = Database::select("SELECT * FROM `grade` WHERE `grade_id`='" . $d["grade_id"] . "'"); //search from grade with the student grade_id
                                                                                                    $grader = $grade->fetch_assoc();
                                                                                                    echo $grader["grade_name"];
                                                                                                    ?></strong></span>
                                                                        </div>

                                                                        <div class="col-12 col-md-6">
                                                                            <span>Gender : <strong>
                                                                                    <?php
                                                                                    if ($d["gender_id"] == "1") { //if gender_id is 1 
                                                                                        echo "Male"; //its male
                                                                                    } else {
                                                                                        echo "Female"; //its female
                                                                                    }
                                                                                    ?>
                                                                                </strong></span>
                                                                        </div>
                                                                        <div class="col-12 col-md-6">
                                                                            <span>Username : <strong><?php echo $d["user_name"] ?></strong></span>
                                                                        </div>
                                                                        <div class="col-12 col-md-6">
                                                                            <span>Email : <strong><?php echo $d["email"] ?></strong></span>
                                                                        </div>
                                                                        <div class="col-12 col-md-6">
                                                                            <span>Account Status : <strong>
                                                                                    <?php
                                                                                    if ($d["status_id"] == "1") {
                                                                                    ?>
                                                                                        <span class="badge rounded-pill alert-success">Unblocked</span>
                                                                                    <?php
                                                                                    } else {
                                                                                    ?>
                                                                                        <span  class="badge rounded-pill alert-danger">Blocked</span>
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                </strong></span>
                                                                        </div>


                                                                        <div class="col-12 col-md-6">
                                                                            <span>Register Date : <strong><?php
                                                                                                            $datee = $d["register_date"]; //we have both date and time we only need the date 
                                                                                                            $splitdt = explode(" ", $datee); //this function will split the registerdate into an array split from space.
                                                                                                            echo $splitdt[0]; //only needs the date 0 index
                                                                                                            ?></strong></span>
                                                                        </div>
                                                                        <div class="col-12 col-md-6">
                                                                            <span>Register Time : <strong><?php
                                                                                                            $datee = $d["register_date"]; //we have both date and time we only need the date 
                                                                                                            $splitdt = explode(" ", $datee); //this function will split the registerdate into an array split from space
                                                                                                            echo $splitdt[1]; //only needs the time 1 index
                                                                                                            ?></strong></span>
                                                                        </div>
                                                                        <div class="col-12 col-md-6">
                                                                            <span>Fee Paid : <strong>

                                                                                    <?php
                                                                                    if ($d["fee_paid"] == '1') {
                                                                                        echo "Yes";
                                                                                    } else {
                                                                                        echo "No";
                                                                                    }
                                                                                    ?>
                                                                                </strong></span>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- this model works as a confirmation model for the admin before blocking or unblocking student-->


                                                <div class="modal fade" id="StudentStatusModel<?php echo $d["student_id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="model-title">Do you want Proceed?</h4>

                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="card-body">
                                                                <?php
                                                                if ($d["status_id"] == 1) {
                                                                ?>
                                                                    <h6 id="exampleModalLabel">Do you want to Block <strong><?php echo $d["first_name"] . " " . $d["last_name"] ?></strong>'s Account</h5>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                        <h6 id="exampleModalLabel">Do you want to Unblock <strong><?php echo $d["first_name"] . " " . $d["last_name"] ?></strong>'s Account</h5>
                                                                        <?php
                                                                    }
                                                                        ?>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="button" class="btn btn-danger" onclick="StudentStatusChange('<?php echo $d['student_id'] ?>')">Proceed</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- this model will pop up when admin click on edit icon to change student grade-->

                                                <div class="modal fade" id="exampleModal<?php echo $d["student_id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Upgrade Student Grade</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-12 d-none">
                                                                        <input type="text" id="sid" value="<?php echo $d["student_id"] ?>" class="form-control">
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label class="form-label">Student Name</label>
                                                                        <!--display student name-->
                                                                        <input type="text" value="<?php echo $d["first_name"] . " " . $d["last_name"] ?>" class="form-control">
                                                                    </div>
                                                                    <div class="col-12 mt-3">
                                                                        <label class="form-label">Current Grade</label>
                                                                        <!--display current grade-->
                                                                        <input type="text" disabled value="Grade <?php echo $grf["grade_name"] ?>" class="form-control">
                                                                    </div>
                                                                    <div class="col-12 mt-3">
                                                                        <!--select tag will be display all the available grades-->
                                                                        <label class="form-label">Select New Grade</label>
                                                                        <select id="ngr<?php echo $d['student_id'] ?>" class="form-select">

                                                                            <?php
                                                                            $gr = Database::select("SELECT * FROM `grade`");
                                                                            $grn = $gr->num_rows;

                                                                            if ($grn > 0) {
                                                                                for ($ig = 0; $ig < $grn; $ig++) {
                                                                                    $grs = $gr->fetch_assoc();

                                                                            ?>
                                                                                    <option value="<?php echo $grs["grade_id"] ?>">Grade <?php echo $grs["grade_name"] ?></option>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary" onclick="upgradeSGrade('<?php echo $d['student_id'] ?>')">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        } else {
                                            //comes to this if theres no row in academic table
                                            echo "no students available";
                                        }
                                        ?>
                                    </table>
                                </div>

                            </div>
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
} else {
?>
    <script>
        window.location = "index.php";
    </script>
<?php
}
