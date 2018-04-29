<?php
include_once 'include_database_info.php';

//same name for database attribute
$file_type = $_POST['file_type'];
//database table the entry belongs in
$table_name = $_POST['table_name'];



//connect to mysql with info from inc_signin_db
$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);


//Insert files
//storage salt for slightly more secure user document storage file name
$storage_salt = substr(sha1(rand()), 0, 5);

$uploadName = $_FILES[$file_type]['name'];
$ext = strtolower(substr($uploadName, strripos($uploadName, '.')+1));
$filename = $file_type . "_" . $storage_salt . "_" . date("Ymd"). "." . $ext;
$upload_location = "../storage/";

//check for file extension type before uploaded
$allowed_extension = array("pdf", "jpg", "jpeg", "png");
if (!in_array($ext, $allowed_extension)) {
  exit("UNACCEPTABLE EXTENSION");
}

//upload file to the directory of user
//*location/restaurantid_filename
//build full address path according to restaurant or user related file

$full_path = $upload_location.$filename;


if (move_uploaded_file($_FILES[$file_type]['tmp_name'], $full_path)) {
  $insert_query = "UPDATE $table_name SET $file_type = '$full_path';";

  $insert_result = mysqli_query($conn, $insert_query);

  if ($insert_result == 1) {
    echo "SUCCESSFULLY UPLOADED";
  } else {
    print $full_path;
    print $insert_query;
    print $insert_result;
    echo "Failed to insert file location to DB. Refresh page";
  }
} else {
  echo "Failed to upload file(s) to file system.";
  print $full_path;
  print $_FILES[$file_type]['tmp_name'];
}

?>
