<?php
include 'inc_signin_db.php';
/*seesech? id ??? */

session_start();

//if there is a live session
if(isset($_SESSION)) {
  $user = $_SESSION['user'];
  //connect to mysql with info from inc_signin_db
  $conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

  $query = "SELECT restaurant_id, restaurant_status, restaurant_name, restaurant_locality, restaurant_administrative_area_level_1, restaurant_image, restaurant_entity
            FROM $dbName.tb_restaurant WHERE user_ref = " . $user['user_id'];

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
