<?php
include_once 'inc_signin_db.php';

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
$user_info = array();


//check if input email already exists
$query = "SELECT * FROM tb_user WHERE user_email = '" . $data["user_email"] . "'";
$result = json_encode(mysqli_fetch_array(mysqli_query($conn, $query)));

//return -1 if email already exists, does not add to database
if ($result != "null") {
	echo "Unavailable";
	//if the email does not exist, add to the database
} else  {
	$user_info["user_first_name"] = $data["user_first_name"];
	$user_info["user_last_name"] = $data["user_last_name"];
	$user_info["user_email"] = $data["user_email"];
	$user_info["user_password"] = password_hash($data["user_password"],PASSWORD_DEFAULT);

	$query = "INSERT INTO tb_user (user_first_name, user_last_name, user_email, user_password) VALUES ('" . $user_info['user_first_name'] . "', '" . $user_info["user_last_name"] . "', '" . $user_info["user_email"] . "', '" . $user_info["user_password"] . "');";
	$result = mysqli_query($conn, $query);

	if ($result == 1) {
		$query = "SELECT user_id FROM tb_user WHERE user_email = '" . $data["user_email"] . "'";
		$result = mysqli_fetch_array(mysqli_query($conn, $query));

		//create a user_info table pointing to new user
		//salt for storage directory
		$storage_salt = substr(sha1(rand()), 0, 15);
		$query = "INSERT INTO tb_user_info (user_ref, user_storage_salt) VALUES ('$result[0]', '$storage_salt');";
		$result = mysqli_query($conn, $query);
		if ($result == 1) {
			//create restaurant storage folder
			$query = "SELECT user_ref FROM tb_user_info WHERE user_storage_salt = '$storage_salt'";
			$result = (mysqli_query($conn, $query));
			$row = mysqli_fetch_array($result);

			//create directory location with restaurant id and storage_salt.
			$file_location = "../noexec/" . $row['restaurant_id'] . "/" . $storage_salt . "/";
			if (!file_exists($file_location)) {
				mkdir($file_location, 0777, true);
				echo "Available";
			} else {
				echo "Failed to create new storage directory";
			}
		} else {
			echo "Database Insert Error2";
		}
	} else {
		echo "Database Insert Error";
	}
}

?>
