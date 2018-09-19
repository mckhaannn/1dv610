<?php

namespace controller;


class LoginController {

  private $view;
  private $credentialManager;
  private $registerView;
  private $registerModel;

  public function __construct(\view\LoginView $view, \model\LoginModel $credentialManager, \view\RegisterView $registerView, \model\RegisterUserModel $registerModel) {
    $this->view = $view; 
    $this->registerView = $registerView; 
    $this->credentialManager = $credentialManager;
    $this->registerModel = $registerModel;
  }
  

  public function registerOrCheckUser() {
    if($this->view->lookForGet()) {
      $this->registerUserToDb();
    } else {
      $this->checkCredentials();
    }
  }
  /**
   * 
   * check if username or password is entered if so sends user credentials to model
   *  @throws Exeption if username or password is missing
   */
  private function checkCredentials() {
    if($this->view->validateUsername() && $this->view->validatePassword()) {
      $this->credentialManager->authenticate($this->view->getRequestUserName(), $this->view->getRequestPassword());
    }
  }

  private function registerUserToDb() {
    if($this->registerView->validateUsername() && $this->registerView->validatePassword()) {
      $this->registerModel->ReciveUsernameAndHashPassword($this->registerView->getRequestRegisterUsername(), $this->registerView->getRequestRegisterPassword());
      $this->registerModel->addUserToDb();
    }
  }

  public function getLoggedInStatus() {
    return $this->credentialManager->getStatus();
  }

  /**
   * render the respons function from LoginView
   * @return function
   */
  public function renderResponse() {
    if($this->view->lookForGet()) {
      return $this->registerView->response();
    } else {
      return $this->view->response();
    }
  }
  public function registerLink() {
    return $this->view->generateRegisterUserLink();
  }
}