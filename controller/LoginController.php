<?php

namespace controller;


class LoginController {

  private $view;
  private $credentialManager;

  public function __construct(\view\LoginView $view, \model\LoginModel $credentialManager) {
    $this->view = $view; 
    $this->credentialManager = $credentialManager;
  }
  
  /**
   * 
   * check if username or passor is entered if so sends user credentials to model
   *  @throws Exeption if username or password is missing
   */
  public function checkCredentials() {
    if($this->view->validateUsername() && $this->view->validatePassword()) {
      $this->credentialManager->authenticate($this->view->getRequestUserName(), $this->view->getRequestPassword());
    }
  }

  /**
   * render the respons function from LoginView
   * @return function
   */
  public function renderResponse() {
    return $this->view->response();
  }
}