<?php
  session_start();
  $session = {};
  $session["user_id"] = $_SESSION["user_id"];
  $session["user_first_name"] = $_SESSION["user_first_name"];
  $session["user_last_name"] = $_SESSION["user_last_name"];

  echo json_encode($session);

}
