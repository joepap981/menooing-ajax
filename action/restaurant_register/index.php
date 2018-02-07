<?php
include_once '../inc_db/inc_signin_db.php';
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
$query = "INSERT INTO " . $dbName . "." . $table_name . "(";

foreach($data as $key => $value) {
  $query = $query . "restaurant_" . $key . ", ";
}

//trim end ,
$query = substr($query, 0, -2) . ") VALUES (";

foreach($data as $key => $value) {
  $query = $query . "'" . $value . "', ";
}

//trim end ,
$query = substr($query, 0, -2) . ");";

$result = (mysqli_query($conn, $query));

if ($result == 1) {
  echo "Success";
} else {
  echo "Failed";
}
