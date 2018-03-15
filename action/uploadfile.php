<?php
include_once 'inc_signin_db.php';
session_start();
$user =  $_SESSION['user'];

$table_name = "tb_restaurant";

//connect to mysql with infor from inc_signin_db
$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

print $_FILES['file']['name'];

?>
