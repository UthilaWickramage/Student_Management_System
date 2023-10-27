<?php
require "../connection/connection.php";
$subject = $_POST["sub"];

if(empty($subject)){
echo "subject field cannot be empty";
}else if(strlen($subject) > 45){
    echo "subject is too long";
}else{
    //check whether such a grade exists
    $r = Database::select("SELECT * FROM `subject` WHERE `subject_name`='".$subject."'");
    $n = $r->num_rows;
    if($n>0){
        echo "Subject already exists";
    }else{
        //if doesnt exist the insert the new grade
        Database::uid("INSERT INTO `subject` (`subject_name`) VALUES ('".$subject."')");
        echo "success";
    }
}
?>