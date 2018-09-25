<?php 

namespace model;

class RegisterUserModel {
  
  private $hashedPassword;
  private $username;
  private $password;
  private $repeatPassword;
  private $exception;
  private $registerStatus;
  public function __construct(\model\ExceptionModel $exception)
  {
    $this->exception = $exception;
  }
  /**
   * recives username and password, hashes the password.
   * 
   * @return void
   */
  public function ReciveUsernameAndPassword($username, $password, $repeatPassword) {
    $this->username = $username;
    $this->password = $password;
    $this->repeatPassword = $repeatPassword;
  }
  
  public function passwordsMatch() {
    return $this->password == $this->repeatPassword && (strlen($this->password) > 5);
  }
  public function checkUsernameLenght() {
    return strlen($this->username) > 2;
  }

  public function checkUsename() {
    include('db.php');
    $result = $connection->prepare("SELECT * FROM users WHERE name=:name");
    $result->bindParam(':name', $this->username);
    $result->execute();
    $matches = $result->fetchColumn(); 
    if($matches) {    
      return false;
    } else {
      return true;
    }
  }
  public function removeTags() {  
    return strip_tags($this->username);
  }

  public function checkIfUsernameContainsInvalidCharacters() {
    if($this->username != strip_tags($this->username)) {
      return false;
    } else {
      return true;
    }
  }
  
  /**
   * Creates a user on the database
   * 
   * @return void
   */
  public function addUserToDb() {
    include('db.php');
    $this->hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (name, password) VALUES (:name, :password)";
    $insertToDb = $connection->prepare($sql);
    $insertToDb->bindParam(':name', $this->username);
    $insertToDb->bindParam(':password', $this->hashedPassword);
    $insertToDb->execute();
    $this->registerStatus = true;
  }
  public function getRegisterStatus() {
    return $this->registerStatus;
  }
}