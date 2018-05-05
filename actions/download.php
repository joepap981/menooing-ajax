<?php
include_once 'include_database_info.php';

//session_start();
//$session_user =  $_SESSION['user'];

//connect to mysql with infor from inc_signin_db
$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

//receive content as json
$postdata = file_get_contents("php://input");

//test if result is received
if(!$postdata) {
	die('Could not read contents of POST request');
}

$data = json_decode($postdata, true);


//if the current session user does not match the request sending user, exit
//if ($session_user['user_id'] != $data['user_id']) {
//  exit('Current user not authorized.');
//}


//code from: https://stackoverflow.com/questions/29079844/download-file-from-server-with-angular-http-get
//read file for download
$file_name = $data['path'];

$abs_file_name = realpath(dirname(__FILE__)).'/'.$file_name;
if(is_file($abs_file_name) && file_exists($abs_file_name)) {

  // required for IE
  if(ini_get('zlib.output_compression')) { ini_set('zlib.output_compression', 'Off'); }

  // get the file mime type using the file extension
  switch(strtolower(substr(strrchr($file_name, '.'), 1))) {
      case 'pdf': $mime = 'application/pdf'; break;
      case 'jpeg':
      case 'jpg': $mime = 'image/jpg'; break;
      case 'png': $mime = 'image/png'; break;
      default: $mime = 'application/force-download';
  }

  header('Content-Description: File Transfer');
  header('Pragma: public');   // required
  header('Expires: 0');       // no cache
  header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
  //header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($abs_file_name)).' GMT');
  //header('Cache-Control: private',false);
  header('Content-Type: '.$mime);
  header('Content-Disposition: attachment; filename='.basename($abs_file_name));
  header('Content-Transfer-Encoding: binary');
  header('Content-Length: '.filesize($abs_file_name));    // provide file size
  //header('Connection: close');
  readfile($abs_file_name);       // push it out
  exit();
} else {
  exit("File does not exist.");
}

?>
