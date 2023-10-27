<?php
session_start();
require "../connection/connection.php";
//this process will release marks to the sudents by the academic officer
if(isset($_SESSION["officer"])){
    if(!empty($_GET["id"])){
        $id = $_GET["id"];

        Database::uid("UPDATE `assignment_marks` SET `status`='1' WHERE `assignment_marks_id`='".$id."'");
        echo "success";
    
    }
}

?>