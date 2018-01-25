<?php
class password_hashing {
  private static $formula = '$2a';
  private static $value = '$10';

  public static function hash ($user_password) {
    return password_hash($user_password, PASSWORD_DEFAULT);
  }
  //compare a password upon hashing
  public static function compare_password($hash, $user_password) {
    $full_salt = substr($hash, 0, 29);
    $new_hash = crypt($user_password, $full_salt);
    return ($hash == $new_hash);
  }
}
 ?>
