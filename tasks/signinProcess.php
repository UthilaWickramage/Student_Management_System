<?php
session_start();
require "../connection/connection.php";
$un = $_POST["un"];
$pw = $_POST["pw"];

$resultset = Database::select("SELECT * FROM `admin` WHERE `admin_name`='" . $un . "' AND `admin_password`='" . $pw . "'");//checks the username and password of the admin
$n = $resultset->num_rows;

if ($n == 1) {//if matched
    $data = $resultset->fetch_assoc();
    $_SESSION["admin"] = $data;//create session

    echo "success";
} else {
    echo "error";
}
