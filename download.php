<?php
    require "function.php";
    $fileName = 'word.doc';
    $filePath = 'assets/upload/fromFile.doc';


if(!empty($fileName) && file_exists($filePath)){

        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");

        readfile($filePath);
        exit;
    }
header('Location:index.php');