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
$insert_to_restaurant_query = "INSERT INTO " . $dbName . ".tb_restaurant (user_ref, ";

foreach($restaurant_info as $key => $value) {
  $insert_to_restaurant_query = $insert_to_restaurant_query . "restaurant_" . $key . ", ";
}
//trim end ', '
$insert_to_restaurant_query = substr($insert_to_restaurant_query, 0, -2) . ") VALUES (" . $user['user_id'] . ", ";
foreach($restaurant_info as $key => $value) {
  $insert_to_restaurant_query = $insert_to_restaurant_query . '"' . $value . '", ';
}
//trim end ', '
$insert_to_restaurant_query = substr($insert_to_restaurant_query, 0, -2) . ");";

//result of insert
$insert_result = (mysqli_query($conn, $insert_to_restaurant_query));
$restaurant_id = mysqli_insert_id($conn);

//make directory to store documents

//get location salt from tb_user_info
$select_query = "SELECT user_storage_salt FROM tb_user_info WHERE user_ref = " . $user['user_id'] . ";";
$storage_salt = mysqli_fetch_array(mysqli_query($conn, $select_query));
$storage_salt = $storage_salt[0];


if ($insert_result == 1) {
	$path = "../noexec/" . $user['user_id'] . "/$storage_salt/$restaurant_id";
	if(mkdir($path)) {
		echo $restaurant_id;
	} else {
		$delete_query = "DELETE FROM $dbName.tb_restaurant WHERE restaurant_id = $restaurant_id";
		$delete_result = mysqli_query($conn, $delete_query);
		exit("Failed to insert Restaurant Info");
	}

}


?>
