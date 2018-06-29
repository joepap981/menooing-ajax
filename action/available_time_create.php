<?php
include_once 'inc_signin_db.php';
session_start();
$user =  $_SESSION['user'];

//connect to mysql with infor from inc_signin_db
$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

//receive content as json
$postdata = file_get_contents("php://input");

//test if result is received
if(!$postdata) {
	die('Could not read contents of POST request');
}

//decoding json into array
$restaurant_info = json_decode($postdata, true);

//start mysql transaction
$transaction_query = "START TRANSACTION;";
$rollback_query = "ROLLBACK";
$commit_query = "COMMIT;";


//create restaurant restaurant
//Building query string for INSERT into database
$insert_query = "INSERT INTO " . $dbName . ".tb_restaurant_available (user_ref, ";

foreach($restaurant_info as $key => $value) {
  $insert_query = $insert_query . " " . $key . ", ";
}
//trim end ', '
$insert_query = substr($insert_query, 0, -2) . ") VALUES (" . $user['user_id'] . ", ";
foreach($restaurant_info as $key => $value) {
  $insert_query = $insert_query . '"' . $value . '", ';
}
//trim end ', '
$insert_query = substr($insert_query, 0, -2) . ");";

//result of insert
$insert_result = (mysqli_query($conn, $insert_query));

//if failed to insert, rollback and exit
if ($insert_result != 1) {
	$rollback_result = mysqli_query($conn, $rollback_query);
	exit("Failed to insert information");
}

echo "Successfully inserted information";

?>
