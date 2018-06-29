<?php
include 'inc_signin_db.php';

//receive content as json
$postdata = file_get_contents("php://input");

//test if result is received
if(!$postdata) {
	die('Could not read contents of POST request');
}

//decoding json into array
//need variables - table, key: value
$data = json_decode($postdata, true);
$condition = $data['condition'];

//build sql query
$query = "DELETE FROM $dbName." . $data['table_name'] . " WHERE ";

foreach($condition as $key => $value) {
  $query = $query . "$key = $value and ";
}

$query = substr($query, 0, -5) . ';';

$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);
$result = mysqli_query($conn, $query);

if($result == 1) {
  echo "SUCCESS";
} else {
  echo "FAILED";
}
