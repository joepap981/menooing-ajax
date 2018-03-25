<?php
include_once 'inc_signin_db.php';

//connect to mysql with infor from inc_signin_db
$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

//receive content as json
$postdata = file_get_contents("php://input");
$data = json_decode($postdata, true);

//test if result is received
if(!$postdata) {
	die('Could not read contents of POST request');
}

$transaction_query = "START TRANSACTION;";
$rollback_query = "ROLLBACK";
$commit_query = "COMMIT;";

//start transaction
$transaction_result = (mysqli_query($conn, $transaction_query));

$update_query = "UPDATE tb_restaurant SET restaurant_status = 'confirmed' WHERE restaurant_id = " . $data['restaurant_ref'] . ";";
$update_result = (mysqli_query($conn, $update_query));

if ($update_result != 1) {
  exit("Failed to update restaurant status");
}

$request_update_query = "UPDATE tb_request SET request_status = 'Handled' WHERE request_id = " . $data['request_id'] . ";";
$request_update_result = (mysqli_query($conn, $request_update_query));

if ($request_update_result != 1) {
  $rollback_result = (mysqli_query($conn, $rollback_query));
  exit("Failed to update request");
} else {
  $commit_result = (mysqli_query($conn, $commit_query));
  echo "Successfully updated restaurant status";
}
