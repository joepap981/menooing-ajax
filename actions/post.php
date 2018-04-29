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

//required data
$data_type = $data['type'];
$tableName = 'tb_' . $data['type'];
$form_id = $data['form_id'];
$postContent = $data['content'];

//build query
$postQuery = "INSERT INTO " . $dbName . "." . $tableName . " (";

foreach($postContent as $key => $value) {
  $postQuery = $postQuery . $data_type . "_$key, ";
}

//trim end ', '
$postQuery = substr($postQuery, 0, -2) . ") VALUES (";
foreach($postContent as $key => $value) {
  $postQuery = $postQuery . '"' . $value . '", ';
}
//trim end ', '
$postQuery = substr($postQuery, 0, -2) . ") WHERE form_id = $form_id;";

//query Database
$postResult = (mysqli_query($conn, $postQuery));

if ($postResult == 1) {
  $recentInsert = mysqli_insert_id($conn);
  exit($recentInsert);
} else {
  print $postResult;
  print $postQuery;
  exit("POST FAILED");

}

?>
