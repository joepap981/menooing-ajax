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
$table_name = $data['table_name'];
$condition = $data['condition'];


//build sql query
if (isset($data['field'])) {
	$field = $data['field'];
	$query = "SELECT ";
	foreach ($field as $word) {
	  $query = $query . "$word, ";
	}
	$query = substr($query, 0, -5) . " ";
	$query = $query . "FROM $dbName.$table_name WHERE ";

} else {

	$query = "SELECT * FROM $dbName.$table_name WHERE ";
}



foreach($condition as $key => $value) {
  $query = $query . "$key = $value and ";
}

$query = substr($query, 0, -5) . ';';

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
