<?php
session_start();
require "connection/connection.php";
if (isset($_SESSION["officer"])) {
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
        <title>Academic | Assignment Results</title>

    </head>

    <body onload="showAnsModal()">


        <?php
        require "./components/aside.php";

        ?>
        <section class="home-section">
            <?php
            require "./components/header.php";
            ?>

            <div class="row">
                <div class="col-10 offset-1">
                    <div class="card p-3 mt-3">
                        <div class="row mt-2">
                            <div class="col-8">
                                <h4 class="text-black-50">Assignment Results</h1>
                            </div>

                        </div>
                        <div class="row mt-2" id="results">
                            <!--submitted results wil be loaded to this div-->
                            <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" style="height: 500px;">
                                <table class="table">
                                    <tr class="fw-bold">
                                        <td>Student Name</td>
                                        <td>Grade</td>
                                        <td>Marks</td>
                                        <td>Status</td>
                                        <td>Action</td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--select assignment model-->
        <div class="modal fade" id="showAnsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Select Assignment </h5>
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
                                    //ook for all the assignment
                                    $assname = Database::select("SELECT assignment.assignment_id,assignment.assignment_name FROM `assignment`");
                                    $assnamen = $assname->num_rows;

                                    if (!$assnamen > 0) {
                                    ?>
                                        <option value="">No Assignment Available</option>
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
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="assignmentSearch()">Search</button>
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
} else {
?>
    <script>
        window.location = "index.php";
    </script>
<?php
}
