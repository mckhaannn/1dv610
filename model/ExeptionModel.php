<?php 

namespace model;
use Exception;
class ExeptionModel {

  public function chechExeptionsUsername($username) {
     if(empty($username)) {
      throw new Exception("Username is missing");
    } 
  } 

}