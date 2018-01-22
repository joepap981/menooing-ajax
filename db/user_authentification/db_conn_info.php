<?php
$dbServerName = "localhost:3307";
$dbUserName = "root";
$dbPassword ="";
$dbName = "loginsystem";

$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

if ($conn){
  print "Connected to ". $dbServerName . ", Accessing database: " . $dbName;
}
else {
  print "Failed!";
}
?>
