<?php
include 'include_database_info.php';

//receive content as json
$postData = file_get_contents("php://input");

//test if result is received
if(!$postData) {
	die('Could not read contents of POST request');
}

//decoding json into array
$table_name = json_decode($postData);

//session_start();

//if there is a live session
//if(isset($_SESSION)) {
  //$user = $_SESSION['user'];
  //connect to mysql with info from inc_signin_db
  $conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

  $query = "SELECT * FROM $dbName.$postData";

  $result = mysqli_query($conn, $query);

  $return_array = array();
  $count=0;
  while ($row = mysqli_fetch_assoc($result))
   {
       $return_array[$count] = $row;
       $count++;
   }

  echo json_encode($return_array);
//} else {
  //echo 'No Session';
//}
