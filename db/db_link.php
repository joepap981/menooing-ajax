<?php

$db_server_name = "localhost:3307";
$db_user_name = "root";
$db_password = "";
$db_name = "loginsystem";

$conn = mysqli_connect($db_server_name, $db_user_name, $db_password, $db_name);

if($conn)  {
  print "Success"
}else {
  print "Failed"
}<?php
