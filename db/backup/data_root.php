<?php
class dataRoot {
  private $conn;
  function __construct() {
    require_once 'db_conn.php';
    $data_base = new db_conn();
    $this->conn = $data_base->connect();
  }

  //Fetching record
  public function getOneRecord ($query) {
    $data_result = $this->conn->query($query . 'LIMIT 1') or die($this->>conn->error . __LINE__);
    return $result = $data_result->fetch_assoc();
  }
  //Create getOneRecord
  public function insertIntoTable ($object, $column_names, $table_name) {
    $com      = (array) $object;
    $keys     = array_keys($com);
    $column   = '';
    $use_data = '';
    foreach ($column_names as $covet_key) {
      if (!in_array($covet_key, $keys)) {
        $$covet_key = '';
      } else {
        $$covet_key = $com[$covet_key];
      }

      $column = $column . $covet_key . ',';
      $use_data = $use_data . "'" . $$covet_key . "',";
    }

    $query = "INSERT INTO " . $table_name . "(" . trim($column, ',') . ") VALUES(" . trim($use_data, ',') . ")";
    $data_result = $this->conn->query($query) or die($this->conn->error . __LINE__);

    if ($data_result) {
      $row_id = $this->conn->insert_id;
      return $row_id;
    } else {
      return NULL;
    }
  }

  public function getSession () {
    if (!isset($_SESSION)) {
      session_start();
    }
    $session_data = array();

    if (isset($_SESSION['user_id'])) {
      $session_data["user_id"] = $_SESSION['user_id'];
      $session_data["user_first_name"] = $_SESSION['user_first_name'];
      $session_data["user_last_name"] = $_SESSION['user_last_name'];
      $session_data['user_email'] = $_SESSION['user_email'];
    } else {
      $session_data['user_id'] = '';
      $session_data['user_first_name'] = 'Guest';
      $session_data['user_last_name'] = '';
      $session_data['user_email'] = '';
    }
    return $session_data;
  }

  public function destroySession () {
    if(!isset($_SESSION)) {
      session_start();
    }
    if (isSet($_SESSION['user_id'])) {
      unset($_SESSION['user_id']);
      unset($_SESSION['user_first_name']);
      unset($_SESSION['user_last_name']);
      unset($_SESSION['user_email']);
      $info = 'info';
      if (isSet($_COOKIE[$info])) {
        setcookie($info, '', time() - $cookie_time);
      }
      $info_msg = "You have successfully logged out!";
    } else {
      $info_msg = "Not Logged in Yet...";
    }
    return $info_msg;
  }
}
?>
