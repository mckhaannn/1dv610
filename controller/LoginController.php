<?php

namespace controller;


class LoginController {

  private $view;
  private $credentialManager;
  private $registerView;
  private $registerModel;
  private $sessionModel;

  public function __construct(\view\LoginView $view, \model\LoginModel $credentialManager, \view\RegisterView $registerView, \model\RegisterUserModel $registerModel, \model\SessionModel $sessionModel) {
    $this->view = $view; 
    $this->registerView = $registerView; 
    $this->credentialManager = $credentialManager;
    $this->registerModel = $registerModel;
    $this->sessionModel = $sessionModel;
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
      if($this->credentialManager->checkUsename($this->view->getRequestUserName())){
        $this->credentialManager->authenticate($this->view->getRequestUserName(), $this->view->getRequestPassword());
        $this->sessionModel->createSession($this->view->getRequestUserName());
      }
    }
  }

  private function registerUserToDb() {
    if($this->registerView->validateUsername() && $this->registerView->validatePassword()) {
      $this->registerModel->ReciveUsernameAndPassword($this->registerView->getRequestRegisterUsername(), $this->registerView->getRequestRegisterPassword(), $this->registerView->getRequestRegisterRepeatPassword());
      if($this->registerModel->passwordsMatch() && $this->registerModel->checkUsename() &&  $this->registerModel->checkUsernameLenght() && $this->registerModel->checkIfUsernameContainsInvalidCharacters()) {
        $this->registerModel->addUserToDb();
        $this->sessionModel->createSession($this->registerView->getRequestRegisterUsername());
        $this->sessionModel->setMessage('Registered new user.');

      }
    }
  }

  public function getLoggedInStatus() {
    return $this->credentialManager->getStatus();
  }
  public function registerStatus() {
    return $this->registerModel->getRegisterStatus();
  }


  /**
   * render the respons function from LoginView
   * @return function
   */
  public function renderResponse() {
    if($this->view->lookForGet()) {
      return $this->registerView->response();
    } else if ($this->view->lookForGet() == false)  {
      return $this->view->response(); 
    } 
  }

  public function returnToLogin() {
    return $this->view->response();
  }
  

  public function registerLink() {
    if(!$this->credentialManager->getStatus()) {
      return $this->view->generateRegisterUserLink();  
    }
  }
}