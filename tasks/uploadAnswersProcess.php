<?php
session_start();
require "../connection/connection.php";
if (isset($_SESSION["student"])) { //session must be student session
    $aid = $_POST["aid"];

    $aidr = Database::select("SELECT * FROM `assignment` WHERE `assignment_id`='" . $aid . "'"); //search for assignment with assignment id
    $aidn = $aidr->num_rows;

    if (!$aidn == 1) { //if no rows found
        echo "Incorrect Assignment ID";
    } else {
        $d = new DateTime(); //create new date time
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s"); //with this format

        $allowed_file_extensions = "application/pdf"; //allowed file extension is only pdf

        if (!isset($_FILES["ansFile"])) { //check whether a file is set
            echo "Please select a PDF file"; //if not
        } else {
            //if set
            $filePDF = $_FILES["ansFile"];
            $file_extension = $filePDF["type"]; //get file extension
            $file_size = $filePDF["size"]; //get file size

            if (!$allowed_file_extensions == $file_extension) { //checks if the extension is pdf
                echo "allow only pdf files";
            } else {
                $aidf = $aidr->fetch_assoc();
                $fileName = $aidf["assignment_name"] . $_SESSION["student"]["student_id"] . uniqid() . ".pdf"; //generate unique file name with assignment name, student name + uniqe id
                move_uploaded_file($filePDF["tmp_name"], "..//data//answers//" . $fileName); //move the file to a permanent location from a temperory location, path will be stored in the database

                Database::uid("INSERT INTO `student_answers` (`answer_file`,`added_date`,`assignment_id`,`student_id`)
                                VALUES ('" . $fileName . "','" . $date . "','" . $aid . "','" . $_SESSION["student"]["student_id"] . "')"); //insert the row to database
                echo "success";
            }
        }
    }
}
