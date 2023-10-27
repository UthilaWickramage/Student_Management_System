<?php

if (!empty($_GET["file"])) {
    $fileName = basename($_GET["file"]);

    $filePath = "../data/assignments/" . $fileName;


    if (!empty($fileName) && file_exists($filePath)) {

        // defining the header
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition:attachment; filename=$fileName");
        header("Content-Type:application/zip");
        header("Content-Transfer-Encoding: binary");

        //reading the file;
        readfile($filePath);
        exit;
    } else {
        echo "file does not exists";
    }
}
