<?php
require "../connection/connection.php";
//activate or deactivate teacher account process
$id = $_GET["id"];

$rs = Database::select("SELECT * FROM `teacher` WHERE `teacher_id`='".$id."'");//check whether therei s a student with the id
$rsn = $rs->num_rows;

if($rsn==1){
$tr = $rs->fetch_assoc();
$sid = $tr["status_id"];

if($sid=="1"){//if status id  is 1 then change the status to 2
    Database::uid("UPDATE `teacher` SET `status_id`='2' WHERE `teacher_id`='".$tr["teacher_id"]."'");
    echo "success";
}else{//if status id  is 2 then change the status to 1
    Database::uid("UPDATE `teacher` SET `status_id`='1' WHERE `teacher_id`='".$tr["teacher_id"]."'");
    echo "success";
}
   
}else{
echo "Invalid Teacher id";
}
