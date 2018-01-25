<?php
include '../inc_db/inc_signin_db.php';

//connect to mysql with infor from inc_signin_db
$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

$data = json_decode(file_get_contents("php://input"));

//email
$user_email = $data->user_email;

$result = '';

$query = "SELECT count(*) as allcount from tb_user WHERE user_email = '" . $user_email . "'";
$row = mysqli_fetch_array(mysqli_query($conn, $query));

$result = "Available";
if($row['allcount'] > 0) {
  $result = 'Not available';
}

echo $result;

?>
