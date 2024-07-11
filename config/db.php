<?php
    $host="localhost";
    $user="root";
    $password="";
    $db_name="benestate";

    $connect = mysqli_connect($host, $user, $password, $db_name);

    if(!$connect) {
        echo "Not connected";
    }