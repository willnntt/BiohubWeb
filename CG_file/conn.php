<?php
    //first'' -> server ip address 
    //second'' -> username for login to database 
    //first'' -> password for login to database
    //first'' -> database name
    $localhost = 'localhost';
    $user = 'root';
    $pass = '';
    $dbName = 'biohub_database';
    
    $conn = mysqli_connect($localhost, $user, $pass, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>