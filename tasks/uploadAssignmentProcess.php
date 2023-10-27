<?php
session_start();
require "../connection/connection.php";

if(isset($_SESSION["teacher"])){ //session must be student session

$aname = $_POST["aname"];
$tsgid = $_POST["tsgid"];
$dur = $_POST["dur"];
$deadl = $_POST["deadl"];

//validations
if(empty($aname)){
  echo  "Please name the assignment";
}else if(empty($dur)){
    echo  "Please add duration for the assignment";
}else if(empty($deadl)){
    echo  "Please add deadline for the assignment";
}else{
    $tsgr = Database::select("SELECT * FROM `teacher_has_grade_has_subject` WHERE `id`='".$tsgid."'"); //search for subject combination from id
    $tsgn = $tsgr->num_rows;

    if(!$tsgn==1){//if no rows found
        echo "select another subject combination";
    }else{
        $d = new DateTime();//create new date time
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s"); //with this format

        $allowed_file_extensions = "application/pdf";//allowed file extension is only pdf

        if(isset($_FILES["file"])){//check whether a file is set
            $filePDF = $_FILES["file"];
            $file_extension = $filePDF["type"];//get file type
            $file_size = $filePDF["size"];//get file size
           
           if(!$allowed_file_extensions == $file_extension){//checks if the extension is pdf
               echo "allow only pdf files";
           }else{

            $fileName = uniqid(). ".pdf"; //file name
            move_uploaded_file($filePDF["tmp_name"],"..//data//assignments//" . $fileName);//move the file to a permanent location from a temperory location, path will be stored in the database

            Database::uid("INSERT INTO `assignment` (`assignment_name`,`assignment_file`,`duration`,`dead_line`,`added_date`,`teacher_has_grade_has_subject_id`,`file_size`)
                            VALUES ('".$aname."','".$fileName."','".$dur."','".$deadl."','".$date."','".$tsgid."','".$file_size."')"); //insert the row to database
                    echo "success";
           }
            

            
        }
    }
    
}
}
