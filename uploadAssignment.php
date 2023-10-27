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
        <title>Teacher | Upload Assignments</title>

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
                                <h4 class="text-black-50">Upload Assignments</h1>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 mt-3">
                                <label for="" class="form-label">Assignment Name</label>
                                <input type="text" id="aname" class="form-control">
                            </div>
                            <div class="col-12 mt-3">
                                <label for="" class="form-label">Select Subject</label>
                                <select id="tsgid" class="form-select">
                                    <?php
                                    //selecting all the subjects available to the teacher
                                    $sc = Database::select("SELECT * FROM `teacher_has_grade_has_subject` INNER JOIN `subject`
                                                        ON `teacher_has_grade_has_subject`.`subject_id`= `subject`.`subject_id`
                                                        INNER JOIN `grade` ON `teacher_has_grade_has_subject`.`grade_id` = `grade`.`grade_id` 
                                                         WHERE teacher_has_grade_has_subject.`teacher_id`='" . $tid . "'");

                                    $scn = $sc->num_rows; // no of rows

                                    if (!$scn > 0) { //if not more than 0
                                    ?>
                                        <option value="0">No Subjects available</option>
                                        <?php
                                    } else {
                                        for ($i = 0; $i < $scn; $i++) {//loop through rows and create assoc arrays and fill the select tag
                                            $scd = $sc->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $scd["id"] ?>">Grade <?php echo $scd["grade_name"] . "-" . $scd["subject_name"] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <label for="" class="form-label">Duration</label>
                                <input type="text" id="dur" class="form-control">
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <label for="" class="form-label">Dead Line</label>
                                <input type="date" id="deadl" class="form-control">
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <label for="" class="form-label">Upload the File(PDF only)</label>
                                <input type="file" id="file" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 d-grid">
                                <button class="btn btn-success" onclick="uploadAssignment()">Upload Assignment</button>
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
} else {//else , no teacher session
?>
    <script>
        window.location = "index.php";
    </script>
<?php
}
