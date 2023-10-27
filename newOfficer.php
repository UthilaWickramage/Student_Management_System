<?php
session_start();

if (isset($_SESSION["admin"])) {//only visisble to admin
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
        <title>Admin | Academic Registration</title>

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
                                <h4 class="text-black-50">Register Acedamic Officer</h1>
                                <!---->
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
                            <div class="col-6">
                                <label for="" class="form-label">Acedamic Id</label>
                                <input type="text" class="form-control" id="aid">
                            </div>
                            <div class="col-6">
                                <label for="" class="form-label">Status</label>
                                <select id="status" class="form-select">
                                    <option value="0">Not Verified</option>
                                    <option value="1">Verified</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <label for="" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="fname">
                            </div>
                            <div class="col-6">
                                <label for="" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lname">
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
                                <button class="btn btn-success" onclick="registerOfficer()">Register Acedamic Officer</button>
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
}else{//no session for admin returns to index
    ?>
    <script>
        window.location = "index.php";
    </script>
<?php
}
