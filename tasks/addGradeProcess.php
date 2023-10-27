<?php
require "../connection/connection.php";
$grade = $_POST["g"];

if(empty($grade)){
echo "subject field cannot be empty";
}else if(strlen($grade) > 45){
    echo "subject is too long";
}else{
    //check whether such a grade exists
    $r = Database::select("SELECT * FROM `grade` WHERE `grade_name`='".$grade."'");
    $n = $r->num_rows;
    if($n>0){
        
        echo "Grade already exists";
    }else{
        //if doesnt exist the insert the new grade
        Database::uid("INSERT INTO `grade` (`grade_name`) VALUES ('".$grade."')");
        echo "success";
    }
}
?>