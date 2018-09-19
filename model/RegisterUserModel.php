<?php 

namespace model;

class RegisterUserModel {
  
  private $hashedPassword;
  private $username;


  /**
   * recives username and password, hashes the password.
   * 
   * @return void
   */
  public function ReciveUsernameAndHashPassword($username, $password) {
    $this->hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $this->username = $username;
    echo $this->hashedPassword;
  }

  /**
   * Creates a user on the database
   * 
   * @return void
   */
  public function addUserToDb() {
    include('db.php');
    $sql = "INSERT INTO users (name, password) VALUES (:name, :password)";
    $setConnection = $connection->prepare($sql);
    $setConnection->bindParam(':name', $this->username);
    $setConnection->bindParam(':password', $this->hashedPassword);
    $setConnection->execute();
  }
}