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
$data = json_decode($postdata, true);
$restaurant_info = json_decode($data['restaurant'], true);
$user_info = json_decode($data['user'], true);

//start mysql transaction
$transaction_query = "START TRANSACTION;";
$rollback_query = "ROLLBACK";
$commit_query = "COMMIT;";
$transaction_result = (mysqli_query($conn, $transaction_query));

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

//if failed to insert, rollback and exit
if ($insert_result != 1) {
	$rollback_result = mysqli_query($conn, $rollback_query);
	exit("Failed to insert Restaurant Info");
	//else get the restaurant id
} else {
	$restaurant_id = mysqli_insert_id($conn);
}

//update user_info according to the information inserted in form
$update_query = "UPDATE $dbName.tb_user_info SET ";

foreach($user_info as $key => $value) {
  $update_query = $update_query . "user_$key = '$value', ";
}

//trim end ,
$update_query = substr($update_query, 0, -2) . " WHERE user_ref = " . $user['user_id'] . ";";

$update_result = (mysqli_query($conn, $update_query));

//if failed to insert, rollback and exit
if ($update_result != 1) {
	$rollback_result = mysqli_query($conn, $rollback_query);
	exit("Failed to insert User Info");
//if successful, return newly created restaurant's restaurant_id
} else {
	//create restaurant folder
	//get location salt from tb_user_info
	$select_query = "SELECT user_storage_salt FROM tb_user_info WHERE user_ref = " . $user['user_id'] . ";";
	$select_result = mysqli_fetch_array(mysqli_query($conn, $select_query));

	$new_directory = "../noexec/" . $user['user_id'] . "/" . $select_result['user_storage_salt'] . "/" . $restaurant_id . '/';

	if (!file_exists($new_directory)) {
		mkdir($new_directory.'restaurant_cert/', 0777, true);
		mkdir($new_directory.'restaurant_image/', 0777, true);
	}
}

//create request for admin to confirm
$create_request_query = "INSERT INTO tb_request (request_type, restaurant_ref, user_ref) " .
	"VALUES ('restaurant_confirmation', $restaurant_id, " . $user['user_id'] . ");";


$create_request_result = (mysqli_query($conn, $create_request_query));

if($create_request_result != 1) {
	$rollback_result = mysqli_query($conn, $rollback_query);
	exit("Failed to create a Confirmation Request");
}
else {
	$commit_result = mysqli_query($conn, $commit_query);
	echo $restaurant_id;
}

?>
