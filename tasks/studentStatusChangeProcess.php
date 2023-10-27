<?php
//activate or deactivate student account process
require "../connection/connection.php";
$id = $_GET["id"];

$rs = Database::select("SELECT * FROM `student` WHERE `student_id`='".$id."'");//check whether therei s a student with the id
$rsn = $rs->num_rows;

if($rsn==1){
$tr = $rs->fetch_assoc();
$sid = $tr["status_id"];

if($sid=="1"){//if status id  is 1 then change the status to 2
    Database::uid("UPDATE `student` SET `status_id`='2' WHERE `student_id`='".$tr["student_id"]."'");
    echo "success";
}else{//if status id  is 2 then change the status to 1
    Database::uid("UPDATE `student` SET `status_id`='1' WHERE `student_id`='".$tr["student_id"]."'");
    echo "success";
}
   
}else{//if no student
echo "Invalid Student id";
}
