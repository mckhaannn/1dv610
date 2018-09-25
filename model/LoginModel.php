<?php

namespace model;

class LoginModel {


  private $status = false;
  // private $userStatus;

  public function authenticate($name, $password) {
    include('db.php');
    $match = $connection->prepare("SELECT * FROM users WHERE name=:name LIMIT 1");
    $match->bindParam(':name', $name);
    $match->execute();
    $results = $match->fetch();
    if($results && password_verify($password, $results['password'])) {
      $this->status = true;
    } else {
      $this->status = false;
    }
  }
  
  public function checkUsename($name) {
    include('db.php');
    $result = $connection->prepare("SELECT * FROM users WHERE name=:name");
    $result->bindParam(':name', $name);
    $result->execute();
    $matches = $result->fetchColumn(); 
    if($matches) {    
      return true;
    } else {
      return false;
    }
  }

  public function getStatus() {
    return $this->status;
  }
}   

