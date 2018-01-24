<?php
include '../inc_db/inc_signin_db.php';
include '../inc_db/inc_password_hashing.php';

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

//query mysql for sql result
$query = "SELECT * FROM tb_user WHERE user_email = '" . $data["user_email"] . "' and user_password = '" . $data["user_password"] . "'";
$result = mysqli_query($conn, $query);

$append_arr = array();  //array to get final result

//check if there are multiple email and password matches
$cnt = 0;
while($listItem = mysqli_fetch_array($result)) {
	$row_array['user_name'] = $listItem['user_first_name'] . " " . $listItem['user_last_name'];
	$cnt++;

	array_push($append_arr,$row_array);// stopped here -> have to makeit appear on table
}

if ($cnt == 0) {
  echo "No email and password matches.";
  return false;
}
else if ($cnt > 1) {
  echo "Error: more than one sql result";
  return false;
} else {
  $return_arr = array('list'=>$append_arr);
  echo json_encode($return_arr);
  return true;
}

mysqli_close($conn);
?>
