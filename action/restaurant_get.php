<?php
include 'inc_signin_db.php';

session_start();

//if there is a live session
if(isset($_SESSION)) {
  //connect to mysql with info from inc_signin_db
  $conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

  $query = "SELECT * FROM " . $dbName . ".tb_restaurant;";
  $result = mysqli_query($conn, $query);

  $return_array = array();
  $count=0;
  while ($row = mysqli_fetch_assoc($result))
   {
       $return_array[$count] = $row;
       $count++;
   }

   echo json_encode($return_array);


} else {
  echo 'No Session';
}
