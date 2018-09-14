<?php

class LoginController {

  /**
   * 
   * check if username or passor is enterd
   *  @throws Exeption if username or password is missing
   */
  public static function checkCredentials($name, $password) {

    if(empty($name)) {
      throw new Exception('Username is missing');
    } else if(empty($password)) {
      throw new Exception('Password is missing');
    } else {
      echo $name . $password;
    }
  
  }
}