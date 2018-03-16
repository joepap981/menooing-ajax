<?php
include_once 'inc_signin_db.php';

//start session
session_start();
$user =  $_SESSION['user'];
$table_name = "tb_user_info";


//connect to mysql with info from inc_signin_db
$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);
$select_query = "SELECT user_storage_salt FROM tb_user_info WHERE user_ref = " . $user['user_id'] . ";";
$select_result = mysqli_fetch_array(mysqli_query($conn, $select_query));

//storage salt for slightly more secure user document storage file name
$storage_salt = substr(sha1(rand()), 0, 10);

$filename = $storage_salt;
$upload_location = "../noexec/" . $user['user_id'] . "/" . $select_result['user_storage_salt'] . "/";

if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_location.$filename)) {
  $insert_query = "UPDATE $table_name SET user_cert_img_ref = '$upload_location$filename';";
  $insert_result = mysqli_query($conn, $insert_query);

  if ($insert_result == 1) {
    echo "Successfully uploaded/inserted.";
  } else {
    echo "Failed to insert to DB.";
  }
} else {
  echo "Failed to upload file.";
}

?>
