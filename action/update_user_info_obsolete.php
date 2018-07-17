<?php
include_once 'inc_signin_db.php';
session_start();
$user =  $_SESSION['user'];

$table_name = "tb_user_info";

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
$update_query = "UPDATE $dbName.$table_name SET ";

foreach($data as $key => $value) {
  $update_query = $update_query . "user_$key = '$value', ";
}

//trim end ,
$update_query = substr($update_query, 0, -2) . " WHERE user_ref = " . $user['user_id'] . ";";
print $update_query;
$result = (mysqli_query($conn, $update_query));


if ($result == 1) {
  echo "Success";
} else {
  echo "Failed";
}

?>
