<?php
$id = $_GET["user"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/bootstrap.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="icon" href="Resources/icons8-education-32.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>Sign In</title>
</head>

<body class="overflow-hidden bg-ligh">
    <div class="">
        <div class="row t">
            <div class="col-12 ">
                <?php

                if ($id == "1") {//if the user click admin button. this is the design
                ?>
                    <div class="row d-flex  align-content-center">

                        <div class="col-4 offset-4" style="padding-top: 100px;">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <i class="bi bi-shield-lock-fill" style="font-size: 92px;"></i>
                                    <br>
                                    <label for="" class="fs-1 fw-bolder">Admin Sign In</label>

                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div id="alertBox" class="d-none">
                                        <i id="signBox" class=""></i>
                                        <div id="textBox" class="ms-3"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label for="" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="un">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label for="" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="pw">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-grid mt-3">
                                    <button href="" class="btn btn-primary" onclick="adminSignIn()">Sign In</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                } else if ($id == 2) {//if the user click academic button. this is the design
                ?>
                    <div class="row">
                        <div class="col-8 text-center text-white d-flex flex-column align-items-center justify-content-center vh-100 acedamic">
                            <div class="row">
                                <div class="col-8 offset-2">
                                    <h6 class=" fs-1">Login as an Acedamic Officer</h6>
                                    <p class="fs-4 ">Register students , View assignment marks and Release Marks to the Students</p>
                                </div>
                            </div>

                        </div>
                        <div class="col-4 bg-light align-content-center" style="padding-top: 100px;">
                            <div class="row mt-5">
                                <div class="col-12 text-center">
                                    <label for="" class="form-label fs-3">Acedamic Officer</label>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-10 offset-1">
                                    <div id="alertBox" class="d-none">
                                        <i id="signBox" class=""></i>
                                        <div id="textBox" class="ms-3"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-10 offset-1">
                                    <label for="" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="uname">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-10 offset-1">
                                    <label for="" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-10 offset-1">
                                    <label onclick="toggleCodeBox()" class="form-label">First Time Login, <strong>Click Here!</strong></label>
                                </div>

                            </div>
                            <div class="row ">
                                <div class="d-none" id="codeBox">
                                    <div class="col-10 offset-1">
                                        <label for="" class="form-label">Code</label>
                                        <input type="text" class="form-control" id="code">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-10 offset-1 d-grid mt-3">
                                    <button href="" class="btn btn-primary" onclick="OfficerSignIn()">Sign In</button>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-10 offset-1 text-center">
                                    <span>Forgot password? <a class="text-link" href="#" onclick="AcademicForgotPassword()"> Click here</a></span>
                                </div>
                            </div>
                        </div>
                    </div>

                     <!-- change password Modal -->
                      <div class="modal fade" id="academicForgotpasswordModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <button type="button" class="btn btn-primary" onclick="changeAcademicpassword()">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                } else if ($id == 3) {//if the user click student button. this is the design
                ?>
                    <div class="row">
                        <div class="col-8 text-center text-white d-flex flex-column align-items-center justify-content-center vh-100 student">
                            <div class="row">
                                <div class="col-8 offset-2">
                                    <h6 class=" fs-1">Login as a Student</h6>
                                    <p class="fs-4 ">Login in as a student, Download Assignments, View lesson notes, Upload Answers</p>
                                </div>
                            </div>

                        </div>
                        <div class="col-4 bg-light align-content-center" style="padding-top: 100px;">
                            <div class="row mt-5">
                                <div class="col-12 text-center">
                                    <label for="" class="form-label fs-3">Student</label>

                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-10 offset-1">
                                    <div id="alertBox" class="d-none">
                                        <i id="signBox" class=""></i>
                                        <div id="textBox" class="ms-3"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-10 offset-1">
                                    <label for="" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="un">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-10 offset-1">
                                    <label for="" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="pw">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-10 offset-1">
                                    <label onclick="toggleCodeBox()" for="" class="form-label">First Time Login, <strong>Click Here!</strong></label>
                                </div>

                            </div>
                            <div class="row ">
                                <div class="d-none" id="codeBox">
                                    <div class="col-10 offset-1">
                                        <label for="" class="form-label">Code</label>
                                        <input type="text" class="form-control" id="code">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-10 offset-1 d-grid mt-3">
                                    <button href="" class="btn btn-primary" onclick="studentSignIn()">Sign In</button>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-10 offset-1 text-center">
                                    <h6>Forgot password? <span class="text-link" onclick="studentForgotPassword()"> Click here</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- change password Modal -->
                    <div class="modal fade" id="studentForgotpasswordModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <button type="button" class="btn btn-primary" onclick="changeStudentpassword()">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                } else if ($id == 4) {//if the user click teacher button. this is the design
                ?>
                    <div class="row">
                        <div class="col-8 text-center text-white d-flex flex-column align-items-center justify-content-center vh-100 teacher">
                            <div class="row">
                                <div class="col-8 offset-2">
                                    <h6 class=" fs-1">Login as a Teacher</h6>
                                    <p class="fs-4 ">Login in as a teacher, Add lesson Notes, Add new Assignments, View Submitted answers and submit marks</p>
                                </div>
                            </div>

                        </div>
                        <div class="col-4 bg-light align-content-center" style="padding-top: 100px;">
                            <div class="row mt-5">
                                <div class="col-12 text-center">
                                    <label for="" class="form-label fs-3">Teacher</label>

                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-10 offset-1">
                                    <div id="alertBox" class="d-none">
                                        <i id="signBox" class=""></i>
                                        <div id="textBox" class="ms-3"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-10 offset-1">
                                    <label for="" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="uname">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-10 offset-1">
                                    <label for="" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-10 offset-1">
                                    <label onclick="toggleCodeBox()" for="" class="form-label">First Time Login, <strong>Click Here!</strong></label>
                                </div>

                            </div>
                            <div class="row">
                                <!--not visible to the user visible only after the togglecodebox function-->
                                <div class="d-none" id="codeBox">
                                    <div class="col-10 offset-1">
                                        <label for="" class="form-label">Code</label>
                                        <input type="text" class="form-control" id="code">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-10 offset-1 d-grid mt-3">
                                    <button href="" class="btn btn-primary" onclick="TeacherSignIn()">Sign In</button>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-10 offset-1 text-center">
                                    <h6>Forgot password? <span class="text-link" onclick="teacherForgotPassword()"> Click here</span></h6>

                                </div>
                            </div>
                        </div>
                    </div>

                     <!-- change password Modal -->
                     <div class="modal fade" id="teacherForgotpasswordModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <button type="button" class="btn btn-primary" onclick="changeTeacherpassword()">Save changes</button>
                                </div>
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



    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>

</body>

</html>