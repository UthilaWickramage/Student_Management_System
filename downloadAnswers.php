<?php
session_start();
require "connection/connection.php";
if (isset($_SESSION["teacher"])) {

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
        <title>Teacher | Download Answers</title>

    </head>

    <body onload="showAnsModal()">
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
                            <div class="col-8">
                                <h4 class="text-black-50">Download Answers</h1>
                            </div>
                        </div>
                        <div class="row mt-2" id="ansBox">
                            <!--available answers will be loaded to this div-->
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--select assignment Modal to view answers sheets -->
        <div class="modal fade" id="showAnsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search Answer Sheets</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label">Assignment Name</label>
                            </div>
                            <div class="col-12">
                                <select class="form-select" id="ass">
                                    <?php
                                    //searching assignment by teacher id
                                    $assname = Database::select("SELECT assignment.assignment_id,assignment.assignment_name FROM teacher_has_grade_has_subject 
                            INNER JOIN assignment ON assignment.teacher_has_grade_has_subject_id=teacher_has_grade_has_subject.id 
                            WHERE teacher_has_grade_has_subject.teacher_id= '" . $_SESSION["teacher"]["teacher_id"] . "';");
                                    $assnamen = $assname->num_rows;

                                    if (!$assnamen > 0) { //if no assignments available
                                    ?>
                                        <option value="">No Assignment Available</option>
                                        <?php
                                    } else {

                                        for ($u = 0; $u < $assnamen; $u++) { //loop through the rows
                                            $assnf = $assname->fetch_assoc(); //assoc arrays
                                        ?>
                                            <option value="<?php echo $assnf["assignment_id"] ?>"><?php echo $assnf["assignment_name"] ?></option>
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
                        <button type="button" class="btn btn-primary" onclick="ansSearch()">Search</button>
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
<?php
} else {//if no teacher session available
?>
    <script>
        window.location = "index.php";
    </script>
<?php
}
