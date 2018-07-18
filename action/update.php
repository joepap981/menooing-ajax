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
$table_name = $data['table_name'];
$condition = $data['condition'];
$update_info = $data['update_info'];

//**** Use this type of POST + GET for user signing and signout later on!! REFACTOR!!!
//Building query string for INSERT into database
$update_query = "UPDATE $dbName.$table_name SET ";

foreach($update_info as $key => $value) {
  $update_query = $update_query . "$key = '$value', ";
}

//trim end ,
$update_query = substr($update_query, 0, -2); //

if($condition != "") {
  $update_query = $update_query  . " WHERE ";
  //iterate through conditions to build query
  foreach($condition as $key => $value) {
    $update_query = $update_query . "$key = $value and ";
  }

  //trim end ,
  $update_query = substr($update_query, 0, -5) . ';';
}
$result = (mysqli_query($conn, $update_query));


if ($result == 1) {
  echo "Successfully updated information";
} else {
  echo "Failed to update information";
}

?>
