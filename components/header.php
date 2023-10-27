<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<div class="row heading">
            <?php
            if (isset($_SESSION["admin"])) {
            ?>
                <div class="col-12 d-flex justify-content-between p-3">
                    <label for="" class="form-label text-white fs-5 ">Admin Dashboard</label>
                    <span onclick="SignOut()" class='bx bx-log-out text-white fs-3 me-3' id="log_out"></span>
                    <span class="tooltip">Log out</span>
                </div>
            <?php
            } else if (isset($_SESSION["officer"])) {
            ?>
                <div class="col-12 d-flex justify-content-between p-3">
                    <label for="" class="form-label text-white fs-5 ">Acedamic Officer Dashboard</label>
                    <span onclick="SignOut()" class='bx bx-log-out text-white fs-3 me-3' id="log_out"></span>
                    <span class="tooltip">Log out</span>
                </div>
            <?php
            } else if (isset($_SESSION["teacher"])) {
            ?>
                <div class="col-12 d-flex justify-content-between p-3">
                    <label for="" class="form-label text-white fs-5 ">Teacher Dashboard</label>
                    <span onclick="SignOut()" class='bx bx-log-out text-white fs-3 me-3' id="log_out"></span>
                    <span class="tooltip">Log out</span>
                </div>
            <?php
            }else if(isset($_SESSION["student"])){
                ?>
                <div class="col-12 d-flex justify-content-between p-3">
                    <label for="" class="form-label text-white fs-5 ">Student Dashboard</label>
                    <span onclick="SignOut()" class='bx bx-log-out text-white fs-3 me-3' id="log_out"></span>
                    <span class="tooltip">Log out</span>
                </div>
            <?php
            }
            ?>
        </div>