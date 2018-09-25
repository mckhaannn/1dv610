<?php 

namespace model;
use Exception;
class ExceptionModel {

  /**
   * checks login credentials and if error adds message to array
   * 
   * @return array
   */
  public function loginCheck($username, $password, $status, $userstatus, $logout) { 
    $messages = array();
    if(empty($username)) {
      array_push($messages, "Username is missing");
    } else if(empty($password)) {
      array_push($messages, "Password is missing");
    } else if($status) {
      array_push($messages, "Welcome");
    } else if($userstatus) {
      array_push($messages, "Wrong name or password");
    } else if ($logout) {
      array_push($messages, "Bye bye!");
    }
    return $messages; 
  }

  /**
   * checks register credentials and if error adds message to array
   * 
   * @return array
   */
  public function registerCheck($username, $password, $repeatePassword, $status, $statement, $usernameStatus) {
    $messages = array();
    if(strlen($username) < 3) {
      array_push($messages, "Username has too few characters, at least 3 characters.");
    } 
    if($password !== $repeatePassword) {
      array_push($messages, "Passwords do not match. User exists, pick another username.");
    }
    if(strlen($password) < 6) {
      array_push($messages, "Password has too few characters, at least 6 characters.");
    }
    if($status) {
      array_push($messages, "Registered new user.");
    }
    if(!$statement && !$status) {
      array_push($messages, "User exists, pick another username.");
    }
    if(!$usernameStatus) {
      array_push($messages, "Username contains invalid characters.");
    } 
    return $messages;
  }

}