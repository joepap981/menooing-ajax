<?php
include 'inc_signin_db.php';

//receive content as json
$postdata = file_get_contents("php://input");

//test if result is received
if(!$postdata) {
	die('Could not read contents of POST request');
}

//decoding json into array
$data = json_decode($postdata, true);

//connect to mysql with info from inc_signin_db
$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

//if the request asks for all restaurants of a certain session user
if ($data['type'] == "USER") {

  session_start();

  //if there is a live session
  if(isset($_SESSION)) {
    $user = $_SESSION['user'];

    $query = "SELECT restaurant_id, restaurant_status, restaurant_name, restaurant_locality, restaurant_administrative_area_level_1, restaurant_image, restaurant_entity
              FROM $dbName.tb_restaurant WHERE user_ref = " . $user['user_id'];

    $result = mysqli_query($conn, $query);

    //build return json
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
//return all restaurants
}else if($data['type'] == 'ALL') {

  $query = "SELECT restaurant_id, restaurant_status, restaurant_name, restaurant_locality, restaurant_administrative_area_level_1, restaurant_image, restaurant_entity
            FROM $dbName.tb_restaurant";

  $result = mysqli_query($conn, $query);

  $return_array = array();
  $count=0;

  if($result != null) {
    while ($row = mysqli_fetch_assoc($result))
   {
       $return_array[$count] = $row;
       $count++;
   }

   echo json_encode($return_array);
 } else {
   echo "No Restaurants";
 }

//return restaurants matching certain condition
} else {
  $request_type = $data["type"];
  $condition = $data["condition"];

  $query = "SELECT restaurant_id, restaurant_status, restaurant_name, restaurant_locality, restaurant_administrative_area_level_1, restaurant_image, restaurant_entity
  FROM $dbName.tb_restaurant WHERE $request_type = '$condition';";

  $result = mysqli_query($conn, $query);

  $return_array = array();
  $count=0;

  if ($result != null) {
    while ($row = mysqli_fetch_assoc($result))
    {
      $return_array[$count] = $row;
      $count++;
    }

    echo json_encode($return_array);
  } else {
    echo "No Match";
  }

}
