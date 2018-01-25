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
$query = "SELECT user_password FROM tb_user WHERE user_email = '" . $data["user_email"] . "'";
$result = mysqli_query($conn, $query);

//check if there are multiple email and password matches
$cnt = 0;
while($listItem = mysqli_fetch_array($result)) {
	$pass_array[$cnt] = $listItem['user_password'];
	$cnt++;
}


if ($cnt == 0) {
  echo "User Not found";
}
else if ($cnt > 1) {
  echo "More than one";
} else {
	if (password_verify($data["user_password"], $pass_array[0])) {
		echo "Success";
	} else {
		echo "Incorrect";
	}
}

mysqli_close($conn);
?>
