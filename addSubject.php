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
        <title>Admin | Manage Subject</title>

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
                    <div class="card bg-light mt-5 p-3">
                        <div class="row mt-2">
                            <div class="col-12">
                                <h4 class="text-black-50">Add a New Subject</h4>
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
                                <table class="table mt-3">
                                    <?php
                                    //loading all the subjects in the subject table
                                    $r = Database::select("SELECT * FROM `subject`");
                                    $n = $r->num_rows;
                                    if ($n > 0) {
                                        for ($i = 0; $i < $n; $i++) {
                                            $d = $r->fetch_assoc();
                                    ?>
                                            <tr>
                                                <td><?php echo $d["subject_name"]?></td>
                                               
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "no subjects available";
                                    }
                                    ?>
                                </table>
                                <table class="table">
                                    <tr>
                                        <td class="mt-3">
                                            <div id="subjectBox" class="d-none">
                                                <div class="input-group mb-3 mt-3">
                                                    <input type="text" class="form-control" id="subject" placeholder="Type new subject....">
                                                    <button class="btn btn-secondary" onclick="addSubject()">Add</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                    <!-- this button will toggle the visibility of the text field -->
                                        <td class="d-flex justify-content-end">
                                            <button class="btn btn-success" onclick="toggleSubjectField()">Add New Subject</button>
                                        </td>
                                    </tr>
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
}else{
    ?>
<script>
    window.location = "index.php";
</script>
    <?php
}
?>