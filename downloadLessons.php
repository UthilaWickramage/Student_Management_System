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
        <title>Student | Download lessons</title>

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
                            <div class="col-8">
                                <h4 class="text-black-50">Download Lessons</h1>
                            </div>
                            <div class="col-4">
                                <div class="input-group"> 
                                <input type="text" class="form-control" id="subject" placeholder="Search Subject">
                                <button class="btn btn-primary" onclick="searchLessons()"><i class='bx bx-search'></i></button>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row mt-3" id="subjectBox">
                        <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" style="height: 500px;">
                        <table class="table">
                                <tr class="fw-bold">
                                    <td>Subject</td>
                                    <td>Teacher</td> 
                                    <td>Description</td>
                                    <td>Added Date</td>
                                    <td></td>
                                  
                                </tr>
                                <?php
                                $ar = Database::select("SELECT *
                                FROM teacher_has_grade_has_subject
                                INNER JOIN teacher ON teacher_has_grade_has_subject.teacher_id = teacher.teacher_id
                                INNER JOIN subject ON subject.subject_id = teacher_has_grade_has_subject.subject_id
                                INNER JOIN grade ON grade.grade_id = teacher_has_grade_has_subject.grade_id
                                INNER JOIN lesson_notes ON lesson_notes.teacher_has_grade_has_subject_id = teacher_has_grade_has_subject.id
                                WHERE teacher_has_grade_has_subject.grade_id = '".$_SESSION["student"]["grade_id"]."'; ");
                                $an = $ar->num_rows;
                                $assf;
                                
                             

                                    if (!$an > 0) {
                                    ?>

<tr>
    <td colspan="5" class="text-center">No Lesson Notes Available</td>
</tr>
<?php
                                        
                                    } else {
                                        $class = array('alert-success','alert-info','alert-warning','alert-danger','alert-primary');
                                        $classbtn = array('btn-success','btn-info');
                                        for ($z = 0; $z < $an; $z++) {
                                            $assf = $ar->fetch_assoc();
                                    ?>
                                    
                                    <tr class="alert <?php echo $class[$z]?>">
                                                <td>Grade <?php echo $assf["grade_name"] . " " . $assf["subject_name"] ?></td>
                                                <td><?php echo $assf["first_name"] . " " . $assf["last_name"] ?></td>
                                                <td><?php echo $assf["description"] ?></td>
                                                <td><?php
                                                    $datee = $assf["added_date"];
                                                    $splitdt = explode(" ", $datee);
                                                    echo $splitdt[0];
                                                    ?></td>
                                                
                                                <td><a href="tasks/downloadLessonsProcess.php?file=<?php echo $assf["lesson_file"] ?>" class="btn <?php echo $classbtn[$z]?> btn-sm">Download</a></td>

                                            </tr>
                                    
                                          

                                    <?php
                                        }
                                    }

                                    ?>



                                <?php
                                

                                ?>
                            </table>
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
} else{
    ?>
<script>
    window.location = "index.php";
</script>
    <?php
}