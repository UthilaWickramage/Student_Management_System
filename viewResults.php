<?php
session_start();
require "connection/connection.php";
if (isset($_SESSION["student"])) {
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
        <title>Student | Results</title>

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
                    <div class="card p-3 mt-3">
                        <div class="row mt-2">
                            <div class="col-8">
                                <h4 class="text-black-50">Assignment Results</h1>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label class="form-label">Subject</label>
                                <select id="subject" class="form-select" onchange="bringAsignments(<?php echo $_SESSION['student']['grade_id'] ?>)"><!--this select will display all the subjects availables for the current grade-->
                                <option value="0">Select Subject</option>
                                    <?php
                                    $sr = Database::select("SELECT `subject`.subject_id,`subject`.subject_name FROM `teacher_has_grade_has_subject` 
                                                            INNER JOIN `subject` ON `subject`.subject_id=`teacher_has_grade_has_subject`.subject_id
                                                            WHERE `grade_id`='" . $_SESSION["student"]["grade_id"] . "'");
                                                            //query t osearch details filter students grade
                                    $srn = $sr->num_rows;//no of rows
                                    
                                    if ($srn > 0) {//if no of rows larger than rows
                                        for ($i = 0; $i < $srn; $i++) {// loop through rows
                                            $sf = $sr->fetch_assoc();//fetch associative arrays
                                        
                                    ?>
                                            <option value="<?php echo $sf["subject_id"] ?>"><?php echo $sf["subject_name"] ?></option>
                                        <?php

                                        }
                                    } else {

                                        ?>
                                        <option value="0">No Subject Available</option>
                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Assignment</label>
                                <select id="aSelect" class="form-select">
                                    <!--options will be loaded via ajax when user called the bring assignment function -->
                                    <option value="0">Please select the subject</option>
                                </select>
                            </div>
                            <div class="col-3 offset-9 d-grid mt-3">
                                <!--student id will be sent as paramenter for the function-->
                                <button class="btn btn-success" onclick="searchResults(<?php echo $_SESSION['student']['student_id']?>)">Search</button>
                            </div>
                        </div>
                        <div class="row" id="rBox">
                            <!--result viewing table will be loaded to this div-->
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
}else{
    ?>
    <script>
        window.location = "index.php";
    </script>
<?php
}
