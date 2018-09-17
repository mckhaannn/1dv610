<?php

namespace model;
include_once('includes/dbh.inc.php');
class LoginModel {

  public function authenticate($name, $password) {

    $sql = "SELECT * FROM Users;";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_num_rows($result);

    if($resultCheck > 0) {
      while(true);
    }
  }
}