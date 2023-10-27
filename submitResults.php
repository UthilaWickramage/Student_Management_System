<?php
session_start();
require "connection/connection.php";
if (isset($_SESSION["teacher"])) {
    $tid =  $_SESSION["teacher"]["teacher_id"];
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
        <title>Teacher | Submit Results</title>

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
                                <h4 class="text-black-50">Declare Results</h1>
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
                            <div class="col-12 mt-3">
                                <label for="" class="form-label">Assignment Name</label>
                                <select class="form-select" id="ass" onchange="bringStudents()">
                                    <option value="0">Assignment Name</option>
                                    <?php
                                    $assname = Database::select("SELECT assignment.assignment_id,assignment.assignment_name FROM teacher_has_grade_has_subject 
                            INNER JOIN assignment ON assignment.teacher_has_grade_has_subject_id=teacher_has_grade_has_subject.id 
                            WHERE teacher_has_grade_has_subject.teacher_id= '" . $_SESSION["teacher"]["teacher_id"] . "';");
                                    $assnamen = $assname->num_rows;

                                    if (!$assnamen > 0) {
                                    ?>
                                        <option value="0">No Assignment Available</option>
                                        <?php
                                    } else {

                                        for ($u = 0; $u < $assnamen; $u++) {
                                            $assnf = $assname->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $assnf["assignment_id"] ?>"><?php echo $assnf["assignment_name"] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="" class="form-label">Select Studnet Name</label>
                                <select id="sname" class="form-select">
                                    <option>Please select an Assignment</option>
                                </select>
                            </div>
                            <div class="col-6 mt-3">
                                <label for="" class="form-label">Marks (%)</label>
                                <input type="text" id="marks" class="form-control">

                            </div>


                        </div>
                        <div class="row mt-4">
                            <div class="col-12 d-grid">
                                <button class="btn btn-success" onclick="submitResult()">Submit Results to Acedamic Officer</button>
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
