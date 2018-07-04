<?php
include_once 'inc_signin_db.php';

//start session
session_start();
$user =  $_SESSION['user'];
//same name for database attribute
$file_type = $_POST['file_type'];
//database table the entry belongs in
$table_name = $_POST['table_name'];
//restaurant_id of uploaded file
$restaurant_id = $_POST['restaurant_id'];


//connect to mysql with info from inc_signin_db
$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

//check if there is an existing file already, get the file location
if($table_name == 'tb_restaurant') {
  $location_query = "SELECT restaurant_cert from $dbName.tb_restaurant WHERE restaurant_id = $restaurant_id";
} else if ($table_name == 'tb_user') {
  $location_query = "SELECT user_cert from $dbName.tb_user_info WHERE user_ref = " . $user['user_id'];
} else {
  exit('Soemething has gone wrong');
}
$location_result = mysqli_fetch_array(mysqli_query($conn, $location_query));
$archive_file_location = $location_result[0];

//get location salt from tb_user_info
$select_query = "SELECT user_storage_salt FROM tb_user_info WHERE user_ref = " . $user['user_id'] . ";";
$select_result = mysqli_fetch_array(mysqli_query($conn, $select_query));

//storage salt for slightly more secure user document storage file name
$uploadName = $_FILES[$file_type]['name'];
$ext = strtolower(substr($uploadName, strripos($uploadName, '.')+1));

$filename = $file_type . '_' . substr(sha1(rand()), 0, 10) . '.' . $ext;
$upload_location = "../noexec/" . $user['user_id'] . "/" . $select_result['user_storage_salt'] . "/";

//check for file extension type before uploaded
$allowed_extension = array("pdf", "jpg", "jpeg", "png");
if (!in_array($ext, $allowed_extension)) {
  exit("UNACCEPTABLE EXTENSION");
}

//upload file to the directory of user
//*location/restaurantid_filename
//build full address path according to restaurant or user related file
if ($table_name == 'tb_restaurant') {
  $full_path = $upload_location.$restaurant_id . '/' . $filename;
} else if ($table_name == 'tb_user'){
  $full_path =  $upload_location . $filename;
}

//if successfully upload file add location to data base
if (move_uploaded_file($_FILES[$file_type]['tmp_name'], $full_path)) {
  if ($table_name == 'tb_restaurant') {
    $insert_query = "UPDATE $table_name SET $file_type = '$full_path' WHERE restaurant_id = $restaurant_id;";
  } else if($table_name == 'tb_user') {
    $insert_query = "UPDATE tb_user_info SET $file_type = '$full_path' WHERE user_ref = " . $user['user_id'] .";";
  } else {}

  $insert_result = mysqli_query($conn, $insert_query);

  if ($insert_result == 1) {
    //delete original file
    if ($archive_file_location == null || $archive_file_location == "") {
      echo "Successfully uploaded file";
    }else {
      unlink($archive_file_location);
      echo "Successfully uploaded file";
    }

  } else {
    echo "Failed to insert file location to DB. Refresh page";
  }
} else {
  echo "Failed to upload file(s) to file system.";
}

?>
