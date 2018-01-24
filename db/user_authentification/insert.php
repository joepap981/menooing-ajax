<?php
//insert.php

  require_once 'db_conn.php';
  $data_base = new db_conn();
  $conn = $data_base->connect();

  $data =  json_decode("php://input");

  if(count($data) >0) {
    $user_first_name = mysqli_real_escape_string($conn, $data->user_first_name);
    $user_last_name = mysqli_real_escape_string($conn, $data->user_last_name);
    $user_email = mysqli_real_escape_string($conn, $data->user_email);
    $user_password = mysqli_real_escape_string($conn, $data->user_password);
  }

  $query = "INSERT INTO tb_user(user_first_name, user_last_name, user_email, user_password)
            VALUES ('$user_first_name', '$user_last_name', '$user_email', '$user_password')";

  if(mysqli_query($conn, $query)) {
    echo 'Success!';
  } else {
    echo 'Error!';
  }

?>
