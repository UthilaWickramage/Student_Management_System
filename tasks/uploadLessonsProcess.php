<?php
session_start();
require "../connection/connection.php";
if (isset($_SESSION["teacher"])) {//session must be student session
    $id = $_POST["tsgid"];
    $desc = $_POST["desc"];

    $aidr = Database::select("SELECT * FROM `teacher_has_grade_has_subject` WHERE `id`='" . $id . "'");//search for subject combination from id
    $aidn = $aidr->num_rows;

    if (!$aidn == 1) {//if no rows found
        echo "Incorrect Subject Combination";
    } else {
        $d = new DateTime();//create new date time
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");//with this format

        $allowed_file_extensions = "application/pdf";//allowed file extension is only pdf

        if (!isset($_FILES["file"])) {//check whether a file is set
            echo "Please select a PDF file";
        } else {

            $filePDF = $_FILES["file"];
            $file_extension = $filePDF["type"];//get file type
            $file_size = $filePDF["size"];//get file size

            if (!$allowed_file_extensions == $file_extension) {//checks if the extension is pdf
                echo "allow only pdf files";
            } else {
                
                $fileName =  uniqid() .".pdf";//file name
                move_uploaded_file($filePDF["tmp_name"], "..//data//lessons//".$fileName);//move the file to a permanent location from a temperory location, path will be stored in the database

                Database::uid("INSERT INTO `lesson_notes` (`lesson_file`,`added_date`,`teacher_has_grade_has_subject_id`,`description`)
                                VALUES ('" . $fileName . "','" . $date . "','" . $id . "','" . $desc . "')");//insert the row to database
                echo "success";
            }
        }
    }
}
