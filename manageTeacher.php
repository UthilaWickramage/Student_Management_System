<?php
session_start();
require "connection/connection.php";
if (isset($_SESSION["admin"])) {
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
        <title>Admin | Manage Teacher</title>

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
                    <div class="card bg-light \ p-3">
                        <div class="row mt-2">
                            <div class="col-12">
                                <h4 class="text-black-50">Teacher List</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" style="height: 500px;">
                                    <table class="table mt-3 align-middle">
                                        <tr class="fw-bold">
                                            <td>Teacher ID</td>
                                            <td>Full Name</td>
                                            <td>Username</td>
                                            <td>Email</td>
                                            <td>Account Status</td>
                                            <td>Action</td>

                                        </tr>
                                        <?php
                                        $r = Database::select("SELECT * FROM `teacher`");
                                        $n = $r->num_rows;
                                        if ($n > 0) {
                                            for ($i = 0; $i < $n; $i++) {
                                                $d = $r->fetch_assoc();
                                        ?>
                                                <tr>
                                                    <td><?php echo $d["teacher_id"] ?></td>
                                                    <td><?php echo $d["first_name"] . " " . $d["last_name"] ?></td>
                                                    <td><?php echo $d["user_name"] ?></td>
                                                    <td><?php echo $d["email"] ?></td>


                                                    <td>
                                                        <?php
                                                        if ($d["account_status"] == "1") {
                                                        ?>
                                                            <span class="badge rounded-pill alert-success">Verified</span>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <span class="badge rounded-pill alert-danger">Not Verified</span>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>

                                                    <td>
                                                        <?php
                                                        if ($d["status_id"] == "1") {
                                                        ?>
                                                            <span role="button" class="badge rounded-pill alert-success" onclick="teacherStatusModel('<?php echo $d['teacher_id'] ?>')">Block teacher</span>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <span role="button" class="badge rounded-pill alert-danger" onclick="teacherStatusModel('<?php echo $d['teacher_id'] ?>')">Unblock Teacher</span>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <button onclick="displayTeacherDetails('<?php echo $d['teacher_id'] ?>')" class="btn btn-light border-1 border-secondary">
                                                            View
                                                        </button>
                                                    </td>


                                                </tr>


                                                <div class="modal fade" id="displayTeacherDetails<?php echo $d['teacher_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel"><?php echo $d["first_name"] . " " . $d["last_name"] ?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col-12">
                                                                    <div class="row gy-3">
                                                                    <div class="col-12">
                                                                            <span>Account Type : <strong>Teacher</strong></span>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <span>Teacher Id : <strong><?php echo $d["teacher_id"] ?></strong></span>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <span>Full Name : <strong><?php echo $d["first_name"] . " " . $d["last_name"] ?></strong></span>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <span>Username : <strong><?php echo $d["user_name"] ?></strong></span>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <span>Email : <strong><?php echo $d["email"] ?></strong></span>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <span>Account Status : <strong>
                                                                                    <?php
                                                                                    if ($d["status_id"] == "1") {
                                                                                    ?>
                                                                                        <span class="badge rounded-pill alert-success" onclick="teacherStatusModel('<?php echo $d['teacher_id'] ?>')">Unblocked</span>
                                                                                    <?php
                                                                                    } else {
                                                                                    ?>
                                                                                        <span class="badge rounded-pill alert-danger" onclick="teacherStatusModel('<?php echo $d['teacher_id'] ?>')">Blocked</span>
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                </strong></span>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <span>Gender : <strong>
                                                                                    <?php
                                                                                    if ($d["gender_id"] == "1") {
                                                                                        echo "Male";
                                                                                    } else {
                                                                                        echo "Female";
                                                                                    }
                                                                                    ?>
                                                                                </strong></span>
                                                                        </div>
                                                                       
                                                                        <div class="col-12">
                                                                            <span>Register Date : <strong><?php echo $d["register_date"] ?></strong></span>
                                                                        </div>
                                                                        
                                                                        <div class="col-12">
                                                                            <div class="card-header">
                                                                                Subjects
                                                                            </div>
                                                                            <div class="card-body">
                                                                            <?php
                                                                            $gs = Database::select("SELECT * FROM `teacher_has_grade_has_subject` INNER JOIN `subject`
                                                                                                     ON `teacher_has_grade_has_subject`.`subject_id`=`subject`.`subject_id` INNER JOIN `grade`
                                                                                                     ON `teacher_has_grade_has_subject`.`grade_id`=`grade`.`grade_id`  WHERE `teacher_id`='".$d["teacher_id"]."';");
                                                                            $gsn = $gs->num_rows;
                                                                            if($gsn>0){
                                                                                for($t=0;$t<$gsn;$t++){
                                                                                    $gsr = $gs->fetch_assoc();
                                                                                    ?>
                                                                                    <p>Grade <?php echo $gsr["grade_name"] . "-" . $gsr["subject_name"]?> </p>
                                                                                    <?php

                                                                                }

                                                                            }
                                                                            ?>
                                                                            
                                                                            </div>
                                                                           
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="modal fade" id="TeacherStatusModel<?php echo $d["teacher_id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                        <h5 id="exampleModalLabel">Do you want to Unblock <strong><?php echo $d["first_name"] . " " . $d["last_name"] ?></strong>'s Account</h5>
                                                                    <?php
                                                                }
                                                                    ?>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="button" class="btn btn-danger" onclick="teacherStatusChange('<?php echo $d['teacher_id'] ?>')">Proceed</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        } else {
                                            echo "no subjects available";
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
