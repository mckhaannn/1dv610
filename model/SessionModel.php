<?php 

namespace model;


class SessionModel {

  public function createSession($username) {
    session_start();
    $_SESSION['username'] = $username;
  }
}