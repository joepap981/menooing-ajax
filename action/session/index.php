<?php
if (!isset($_SESSION))
{
    session_start();
}

$user['user_id'] = $_SESSION['user_id'];
$user['user_first_name'] = $_SESSION['user_first_name'];
$user['user_last_name'] = $_SESSION['user_last_name'];


echo json_encode($user);
?>
