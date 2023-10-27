<?php
session_start();
require "connection/connection.php";
if (isset($_SESSION["admin"])) {//check the session for admin session

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
        <title>Admin | Manage Academic</title>

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
                <div class="col-12 ">
                    <div class="card bg-light \ p-3">
                        <div class="row mt-2">
                            <div class="col-12">
                                <h4 class="text-black-50">Acedamic Officer List</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" style="height: 500px;">
                                <!--table that display officer details-->
                                    <table class="table mt-3">
                                        <tr class="fw-bold">
                                            <td>Acedamic ID</td>
                                            <td>Full Name</td>
                                            <td>Username</td>
                                            <td>Email</td>
                                            <td>Account Status</td>

                                        </tr>
                                        <?php
                                        $r = Database::select("SELECT * FROM `acedamic`");//search complete academic table
                                        $n = $r->num_rows;//find number of rows in full academic table
                                        if ($n > 0) {//goes in only number of rows are more than 0
                                            for ($i = 0; $i < $n; $i++) {//loop through rows
                                                $d = $r->fetch_assoc();//put row in to an associative array
                                                //display details from associative array
                                        ?>
                                                <tr>
                                                    <td><?php echo $d["acedamic_id"] ?></td>
                                                    <td><?php echo $d["first_name"] . " " . $d["last_name"] ?></td>
                                                    <td><?php echo $d["user_name"] ?></td>
                                                    <td><?php echo $d["email"] ?></td>


                                                    <td>
                                                        <?php
                                                        if ($d["account_status"] == "1") {//if works only if the account status of the officer is 1. which is a verified user
                                                        ?>
                                                            <span class="badge rounded-pill alert-success">Verified</span>
                                                        <?php
                                                        } else {//if status is 0, an user whose yet to login to the system
                                                        ?>
                                                            <span class="badge rounded-pill alert-danger">Not Verified</span>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>

                                                    <td>
                                                        <?php
                                                        if ($d["status_id"] == "1") {//if works only if officer account active.admin can block account by clicking
                                                        ?>
                                                            <span role="button" class="badge rounded-pill alert-success" onclick="officerStatusModel('<?php echo $d['acedamic_id'] ?>')">Block Officer</span>
                                                        <?php
                                                        } else {//if works only if officer account inactive. 
                                                        ?>
                                                            <span role="button" class="badge rounded-pill alert-danger" onclick="officerStatusModel('<?php echo $d['acedamic_id'] ?>')">Unblock Officer</span>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>

                                                </tr>
                                                <!-- this model works as a confirmation model for the admin-->
                                                <div class="modal fade" id="OfficerStatusModel<?php echo $d["acedamic_id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="model-title">Do you want Proceed?</h4>

                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="card-body">
                                                                <?php
                                                                if ($d["status_id"] == 1) {
                                                                ?>
                                                                    <h6 id="exampleModalLabel">Do you want to Block <strong><?php echo $d["first_name"] . " " . $d["last_name"] ?></strong>'s Account</h5>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                        <h6 id="exampleModalLabel">Do you want to Unblock <strong><?php echo $d["first_name"] . " " . $d["last_name"] ?></strong>'s Account</h5>
                                                                    <?php
                                                                }
                                                                    ?>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="button" class="btn btn-danger" onclick="officerStatusChange('<?php echo $d['acedamic_id'] ?>')">Proceed</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        } else {
                                            //comes to this if theres no row in academic table
                                            echo "no subjects available";
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
} else {//if the session does not belong to a admin the he will be redirected to the index
?>
    <script>
        window.location = "index.php";
    </script>
<?php
}
