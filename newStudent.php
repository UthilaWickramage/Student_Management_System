<?php
session_start();
require "connection/connection.php";
if (isset($_SESSION["officer"])) {//only visisble to officer
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
        <title>Academic | Student Registration</title>

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
                    <div class="card bg-light p-3 mt-3">
                        <div class="row mt-2">
                            <div class="col-12">
                                <h4 class="text-black-50">Register Student</h1>
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
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="" class="form-label">Student Enroll Id</label>
                                <input type="text" class="form-control" id="eid">
                            </div>

                        </div>
                        <div class="row mt-2">
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="fname">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lname">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label">Birth Day</label>
                                <input type="date" class="form-control" id="bday">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label">Grade</label>
                                <div class="input-group">
                                    <span class="input-group-text">Grade</span>
                                    <select id="g" class="form-select">
                                        <?php
                                        //select all grades
                                        $g = Database::select("SELECT * FROM `grade`");
                                        $ng = $g->num_rows;
                                        for ($i = 0; $i < $ng; $i++) {
                                            $d = $g->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $d["grade_id"] ?>"><?php echo $d["grade_name"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label">Gender</label>
                                <select id="gender" class="form-select">
                                    <?php
                                    //select all genders
                                    $r = Database::select("SELECT * FROM `gender`");
                                    $n = $r->num_rows;
                                    for ($i = 0; $i < $n; $i++) {
                                        $d = $r->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $d["gender_id"] ?>"><?php echo $d["gender_name"] ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label">Status</label>
                                <select id="status" class="form-select">
                                    <option value="0">Not Verified</option>
                                    <option value="1">Verified</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="" class="form-label">Username</label>
                                <input type="text" class="form-control" id="uname">
                            </div>

                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 d-grid">
                                <button class="btn btn-success" onclick="registerStudent()">Register Student</button>
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
}else{//no officer session returns to index
    ?>
    <script>
        window.location = "index.php";
    </script>
<?php
}

