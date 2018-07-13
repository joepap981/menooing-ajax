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
$restaurant_ref = $data['restaurant_ref'];
$info = $data['condition'];

//start mysql transaction
$transaction_query = "START TRANSACTION;";
$rollback_query = "ROLLBACK";
$commit_query = "COMMIT;";

//start transaction
mysqli_query($conn, $transaction_query);

//create request
$create_request_query = "INSERT INTO $dbName.tb_request (user_ref, request_type, request_host_restaurant_ref) VALUES (" . $user['user_id'] . ", 'rent_request', $restaurant_ref);";
$create_request_result = (mysqli_query($conn, $create_request_query));

if($create_request_result != 1) {
  exit('Failed to create request');
} else {
  $request_id = mysqli_insert_id($conn);
}

foreach($info as $condition) {

  //create restaurant restaurant
  //Building query string for INSERT into database
  $insert_query = "INSERT INTO $dbName.tb_rent_time (request_ref, ";

  foreach($condition as $key => $value) {
    $insert_query = $insert_query . " " . $key . ", ";
  }
  //trim end ', '
  $insert_query = substr($insert_query, 0, -2) . ") VALUES ($request_id, ";
  foreach($condition as $key => $value) {
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
}

mysqli_query($conn, $commit_query);
echo "Successfully inserted information";
?>
