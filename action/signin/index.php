<?php
include '../inc_db/inc_signin_db.php';

session_start();

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
$query = "SELECT * FROM tb_user WHERE user_email = '" . $data["user_email"] . "'";
$result = mysqli_query($conn, $query);

//check if there are multiple email and password matches
$cnt = 0;
while($listItem = mysqli_fetch_array($result)) {
	$pass_array['user_password'] = $listItem['user_password'];
	$pass_array['user_id'] = $listItem['user_id'];
	$pass_array['user_email'] = $listItem['user_email'];
	$pass_array['user_first_name'] = $listItem['user_first_name'];
	$pass_array['user_last_name'] = $listItem['user_last_name'];
	$cnt++;
}


if ($cnt == 0) {
  echo "User Not found";
}
else if ($cnt > 1) {
  echo "More than one";
} else {
	if (password_verify($data["user_password"], $pass_array["user_password"])) {
		//Session data store



		$_SESSION["user_id"] = $pass_array['user_id'];
		$_SESSION["user_first_name"] = $pass_array['user_first_name'];
		$_SESSION["user_last_name"] = $pass_array['user_last_name'];

		echo json_encode($_SESSION);

		//echo "Success";

	} else {
		echo "Incorrect";
	}
}

mysqli_close($conn);
?>
