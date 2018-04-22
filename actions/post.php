<?php
include_once 'include_database_info.php';

//connect to mysql with infor from include_database_info
$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

//disconnect if cannot connect to database
if ($conn == null) {
  exit("Connection to Database Failed");
}

//receive content as json
$postData = file_get_contents("php://input");

//test if result is received
if(!$postData) {
	die('Could not read contents of POST request');
}

//decoding json into array
$data = json_decode($postData, true);
$user_info = array();

echo $postData;
