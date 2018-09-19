<?php

namespace model;

class LoginModel {


  private $status;

  public function authenticate($name, $password) {
    include('db.php');
    $match = $connection->prepare("SELECT * FROM users WHERE name=:name LIMIT 1");
    $match->bindParam(':name', $name);
    $match->execute();
    $results = $match->fetch();

    if(count($results) > 0 && password_verify($password, $results['password'])) {
      $this->status = true;
      } else {
      $this->status = false;
    }
  }
  public function getStatus() {
    return $this->status;
  }

}

