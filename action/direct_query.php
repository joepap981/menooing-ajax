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
$query =$postdata;

$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);
$result = mysqli_query($conn, $query);

$return_array = array();
$count=0;

while ($row = mysqli_fetch_assoc($result))
 {
     $return_array[$count] = $row;
     $count++;
 }

echo json_encode($return_array);
