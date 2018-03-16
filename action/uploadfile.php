<?php
include_once 'inc_signin_db.php';

//start session
session_start();
$user =  $_SESSION['user'];


//connect to mysql with info from inc_signin_db
$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

$table_name = "tb_restaurant";

$filename = $_FILES['file']['name'];
$upload_location = "../noexec/";
move_uploaded_file($_FILES['file']['tmp_name'],$upload_location.$filename);

?>
