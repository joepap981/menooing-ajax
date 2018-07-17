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
$user_id = json_decode($postdata, true);

//connec to db
$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

$query = "SELECT user_id, user_first_name, user_last_name FROM $dbName.tb_user WHERE user_id = $user_id;";

$result = mysqli_query($conn, $query);

$return_array = array();
$count=0;

while ($row = mysqli_fetch_assoc($result))
 {
     $return_array[$count] = $row;
     $count++;
 }

session_start();

$_SESSION['user'] = $return_array;

echo json_encode($_SESSION['user']);
?>
