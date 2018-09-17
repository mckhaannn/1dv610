<?php

namespace controller;


class LoginController {

  private $view;

  public function __construct(\view\LoginView $view) {
    $this->view = $view; 
  }
  
  /**
   * 
   * check if username or passor is enterd
   *  @throws Exeption if username or password is missing
   */
  public function checkCredentials() {
    // $this->view->response();
    var_dump($this->view->validateUsername());
    var_dump($this->view->validatePassword());
    if($this->view->validateUsername() && $this->view->validatePassword()) {
      // echo $this->view->getRequestUserName();
    }
  }

  public function renderResponse() {
    return $this->view->response();
  }
}