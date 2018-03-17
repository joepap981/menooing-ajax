<?php
include_once 'inc_signin_db.php';

//start session
session_start();
$user =  $_SESSION['user'];
$file_type = $_POST['file_type'];
$table_name = $_POST['table_name'];

//connect to mysql with info from inc_signin_db
$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);
$select_query = "SELECT user_storage_salt FROM tb_user_info WHERE user_ref = " . $user['user_id'] . ";";
$select_result = mysqli_fetch_array(mysqli_query($conn, $select_query));

//storage salt for slightly more secure user document storage file name
$filename = $file_type . substr(sha1(rand()), 0, 10);
$upload_location = "../noexec/" . $user['user_id'] . "/" . $select_result['user_storage_salt'] . "/";

//upload file to the directory of user
if (move_uploaded_file($_FILES[$file_type]['tmp_name'], $upload_location.$filename)) {
  $insert_query = "UPDATE $table_name SET $file_type = '$upload_location$filename';";
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
