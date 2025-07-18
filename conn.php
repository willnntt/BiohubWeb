<?php
$localhost = 'localhost';
$user = 'root';
$pass = '';
$dbName = 'biohub_database';

$dbConn = mysqli_connect($localhost, $user, $pass, $dbName);

// Also define $conn (alias for dbConn)
$conn = $dbConn; 

if(mysqli_connect_errno()){
    die('<script>alert("Connection failed: Please check your SQL connection");</script>');
}
?>
