<?php
    $servername = "localhost";
    $username = "admin";
    $password = "1111";
    $dbname   = 'logger';
    
    // Create connection to database
    $connect = mysqli_connect($servername, $username, $password, $dbname);

    // Check onnection database
    if (!$connect) {
        echo 'error';
    }
    

    