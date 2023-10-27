<?php
require "../connection/connection.php";
$id = $_GET["id"];
//check whether theres a officer with the id
$rs = Database::select("SELECT * FROM `acedamic` WHERE `acedamic_id`='".$id."'");
$rsn = $rs->num_rows;

if($rsn==1){//if it is
$tr = $rs->fetch_assoc();
$sid = $tr["status_id"];

if($sid=="1"){//if the status id is 1 then change to 2
    Database::uid("UPDATE `acedamic` SET `status_id`='2' WHERE `acedamic_id`='".$tr["acedamic_id"]."'");
    echo "success";
}else{//if the status id is 2 then change to 1
    Database::uid("UPDATE `acedamic` SET `status_id`='1' WHERE `acedamic_id`='".$tr["acedamic_id"]."'");
    echo "success";
}
   
}else{//comes here if wrong id
echo "Invalid Academic id";
}
