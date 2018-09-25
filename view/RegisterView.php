<?php

namespace view;

class RegisterView {
  private static $register = 'RegisterView::Register';
  private static $messageId = 'RegisterView::Message';
	private static $name = 'RegisterView::UserName';
	private static $password = 'RegisterView::Password';
	private static $passwordRepeate = 'RegisterView::PasswordRepeat';
	private $exception;
	private $rum;

	public function __construct(\model\ExceptionModel $exception, \model\RegisterUserModel $rum)
	{
		$this->exception = $exception;
		$this->rum = $rum;
	}



	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {
		$message = '';
		if(isset($_POST[self::$register])) {
			$message = $this->printMessages();
		}
		$response = $this->generateRegisterForm($message);
		return $response;
	}

	public function printMessages(){
		$mess = null;
		$arr = $this->exception->registerCheck($this->getRequestRegisterUsername(), $this->getRequestRegisterPassword(), $this->getRequestRegisterRepeatPassword(), $this->rum->getRegisterStatus(), $this->rum->checkUsename(), $this->rum->checkIfUsernameContainsInvalidCharacters());
		foreach($arr as $value) {
			$mess .= $value . '<br>';
		}
		return $mess;
	}
	public function saveUsername() {
		if(!$this->rum->checkIfUsernameContainsInvalidCharacters()) {
			return $this->rum->removeTags();
		} else if(isset($_POST[self::$name])) {
			return $_POST[self::$name];
		}
	}
	public function redirectToLogin() {
		session_start();
		if(isset($_POST[self::$register])) {
			if($this->rum->getRegisterStatus()) {
				$_SESSION['successfullRegister'] = TRUE;
				header("location:" . $_SESSION['redurectURL']);
			}
		}
	}
  
  public function generateRegisterForm($message) {
    return '
    <form action="?register" method="post" > 
      <fieldset>
        <legend>Register a new user - Write username and password</legend>
        <p id="' . self::$messageId . '">' . $message . '</p>
        <label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->saveUsername() . '" />

					<label for="' . self::$password . '">Password :</label>
          <input type="password" id="' . self::$password . '" name="' . self::$password . '" />
          
					<label for="' . self::$passwordRepeate . '">Repeate Password :</label>
					<input type="password" id="' . self::$passwordRepeate . '" name="' . self::$passwordRepeate . '" />
					
					<input type="submit" name="' . self::$register . '" value="Register" />
      </fieldset>
    </form>
    ';
	}

	/** 
	* Validates the username
	* 
	* @return bool
	*/
	public function validateUsername() : bool {
		return isset($_POST[self::$name]) && !empty($_POST[self::$name]);
	}

	public function lookForPost() : bool {
		return isset($_POST['register']);
	}
	/** 
	 * Validates the password
	 * 
	 * @return bool 
	 */ 

	public function validatePassword() : bool {
		return isset($_POST[self::$password]) && !empty($_POST[self::$password]);
	}

  public function getRequestRegisterUsername() {
		return $_POST[self::$name];
	}
	public function getRequestRegisterPassword() {
		return $_POST[self::$password];
	}
	public function getRequestRegisterRepeatPassword() {
		return $_POST[self::$passwordRepeate];
	}
}