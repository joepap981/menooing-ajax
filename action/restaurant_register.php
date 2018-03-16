<?php
include_once 'inc_signin_db.php';
session_start();
$user =  $_SESSION['user'];

$table_name = "tb_restaurant";

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


//**** Use this type of POST + GET for user signing and signout later on!! REFACTOR!!!
//Building query string for INSERT into database

$query = "INSERT INTO " . $dbName . "." . $table_name . "(user_ref, restaurant_storage_salt, ";

foreach($data as $key => $value) {
  $query = $query . "restaurant_" . $key . ", ";
}
//storage salt for slightly more secure user document storage directory name
$storage_salt = substr(sha1(rand()), 0, 15);
//trim end ,
$query = substr($query, 0, -2) . ") VALUES (" . $user['user_id'] . ", '$storage_salt', ";

foreach($data as $key => $value) {
  $query = $query . '"' . $value . '", ';
}

//trim end ,
$query = substr($query, 0, -2) . ");";

$result = (mysqli_query($conn, $query));

if ($result == 1) {
	//create restaurant storage folder
	$query = "SELECT restaurant_id FROM tb_restaurant WHERE restaurant_storage_salt = '$storage_salt'";
	$result = (mysqli_query($conn, $query));
	$row = mysqli_fetch_array($result);

	//create directory location with restaurant id and storage_salt.
	$file_location = "../noexec/" . $row['restaurant_id'] . "/" . $storage_salt . "/";
	if (!file_exists($file_location)) {
    mkdir($file_location, 0777, true);
		echo "Success";
	} else {
		echo "Failed to Create Directory";
	}
} else {
  echo "Failed to write to DB";
}
