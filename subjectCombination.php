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
        <title>Admin | Subject Combinations</title>

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
                                <h4 class="text-black-50">Assign Teacher a Subject</h1>
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
                            <div class="col-12 col-md-4">
                                <label for="" class="form-label">Select Teacher</label>
                                <select id="t" class="form-select">
                                    <?php
                                    //select all teachers
                                    $tr = Database::select("SELECT * FROM `teacher`");
                                    $tn = $tr->num_rows;

                                    if ($tn == 0) {
                                    ?>
                                        <option value="0">No Data Available</option>
                                        <?php
                                    } else {
                                        for ($i = 0; $tn > $i; $i++) {
                                            $tf = $tr->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $tf["teacher_id"] ?>"><?php echo $tf["first_name"] . " " . $tf["last_name"] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>

                                </select>
                            </div>

                            <div class="col-12 col-md-4">
                                <label for="" class="form-label">Select Grade</label>
                                <select id="g" class="form-select">
                                    <?php
                                    //select all grades
                                    $gr = Database::select("SELECT * FROM `grade`");
                                    $gn = $gr->num_rows;

                                    if ($gn == 0) {
                                    ?>
                                        <option value="0">No Data Available</option>
                                        <?php
                                    } else {
                                        for ($i = 0; $gn > $i; $i++) {
                                            $gf = $gr->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $gf["grade_id"] ?>">Grade <?php echo $gf["grade_name"] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>

                                </select>
                            </div>



                            <div class="col-12 col-md-4">
                                <label for="" class="form-label">Select Subject</label>
                                <select id="s" class="form-select">
                                    <?php
                                    //select all subjects
                                    $sr = Database::select("SELECT * FROM `subject`");
                                    $sn = $sr->num_rows;

                                    if ($sn == 0) {
                                    ?>
                                        <option value="0">No Data Available</option>
                                        <?php
                                    } else {
                                        for ($y = 0; $sn > $y; $y++) {
                                            $sf = $sr->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $sf["subject_id"] ?>"><?php echo $sf["subject_name"] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12 d-grid">
                                <button class="btn btn-success" onclick="assignTeacher()">Assign Teacher</button>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
                                    <table class="table mt-3 align-middle">
                                        <tr class="fw-bold">
                                            <td>Teacher Id</td>
                                            <td>Teacher Name</td>
                                            <td>Grade</td>
                                            <td>Subject</td>



                                        </tr>
                                        <?php
                                        //get all teacher subject combination limited to 5
                                        $r = Database::select("SELECT * FROM `teacher_has_grade_has_subject`");
                                        $n = $r->num_rows;
                                        if ($n > 0) {
                                            for ($i = 0; $i < $n; $i++) {
                                                $d = $r->fetch_assoc();
                                        ?>
                                                <tr>
                                                    <td><?php
                                                        $t = Database::select("SELECT * FROM `teacher` WHERE `teacher_id`='" . $d["teacher_id"] . "'");
                                                        $tr = $t->fetch_assoc();
                                                        echo $tr["teacher_id"];
                                                        ?></td>
                                                    <td><?php echo $tr["first_name"] . " " . $tr["last_name"] ?></td>
                                                    <td><?php
                                                        $grade = Database::select("SELECT * FROM `grade` WHERE `grade_id`='" . $d["grade_id"] . "'");
                                                        $gr = $grade->fetch_assoc();
                                                        ?>Grade <?php echo $gr["grade_name"];
                                                                ?></td>
                                                    <td><?php
                                                        $subject = Database::select("SELECT * FROM `subject` WHERE `subject_id`='" . $d["subject_id"] . "'");
                                                        $sr = $subject->fetch_assoc();
                                                        echo $sr["subject_name"];
                                                        ?></td>
                                                  
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
