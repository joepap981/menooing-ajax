<?php
include 'inc_signin_db.php';
session_start();

//check to see if there is a use in session
if(!isset($_SESSION['user'])) {
  echo "NO SESSION";
  exit();
} else {
  $user = $_SESSION['user'];
}

//receive content as json
$postdata = file_get_contents("php://input");

//test if result is received
if(!$postdata) {
	die('Could not read contents of POST request');
}

//decoding json into array
$restaurant_id = json_decode($postdata, true);

//connect to mysql with infor from inc_signin_db
$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

//query mysql for sql result
//search for a restaurant with the session user's user_id and the given restaurant id
$query = "SELECT user_ref FROM $dbName.tb_restaurant WHERE user_ref = " . $user['user_id'] . " and restaurant_id = $restaurant_id;";
$result = mysqli_fetch_assoc(mysqli_query($conn, $query));

mysqli_close($conn);
if ($user["user_id"] == $result["user_ref"] || $user["user_id"] == 1) {
  echo "ACCEPTED";
} else {
  echo "DENIED";
}

?>
