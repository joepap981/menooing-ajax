<?php
//Database connection
define($dbServerName, "localhost:3307");
define(define($dbUserName, "root");
define($dbPassword, "");
define($dbName, "loginsystem");

class db_conn {
  private $conn;
  function __construct() {
  }

  function connect () {
    $this->conn = new mysqli($dbServerName, $dbUserName, $dbPassword, $dbName);
    if (mysqli_connect_errno()) {
      echo "Connection failed" . mysqli_connect_errno();
    }
    return $this->conn;
  }
}
?>
