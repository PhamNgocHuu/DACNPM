<?php

    $sever = 'localhost';
    $user ='root';
    $pass = '';
    $database = 'webtintuc';

    $connect = new mysqli($sever, $user, $pass, $database);

    if($connect)
    {
        mysqli_query($connect,"SET NAMES 'UTF8'");
        
    }
    else
    {
        echo 'Kết nối thất bại';
    }
?>