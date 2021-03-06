<?php
namespace view;
use Exception;
class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';
	private static $sessionUser = 'LoginView::SessionUser';
	private $exception;

	public function __construct(\model\ExceptionModel $exception, \model\LoginModel $loginModel, \model\RegisterUserModel $registerModel)
	{		
		$this->exception = $exception;
		$this->loginModel = $loginModel;
		$this->registerModel = $registerModel;
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
		if(!empty($_POST[self::$login])) {
			$message = $this->printMessages();
		}
		if(isset($_SESSION['message'])) {
			$message = 'Registered new user.';
			$response = $this->generateLoginFormHTML($message);
			
		}
		// var_dump(isset($_SESSION['username']));
		if(!empty($_REQUEST[self::$logout])) {

			$message = 'Bye bye!';

			$response = $this->generateLoginFormHTML($message);
		}
		$response = $this->generateLoginFormHTML($message);
		if($this->loginModel->getStatus()) {
			$response = $this->generateLogoutButtonHTML($message);
			return $response;
		} else {
			return $response;
		}
	}

	
	/**
	 * Generate HTML code on the output buffer for the logout button
	 * @param $message, String output message
	 * @return  void, BUT writes to standard output!
	 */
	private function generateLogoutButtonHTML($message) {
		return '
		<form  method="post" >
		<p id="' . self::$messageId . '">' . $message .'</p>
		<input type="submit" name="' . self::$logout . '" value="logout"/>
		</form>
		';
	}
	
	/**
	 * Generate HTML code on the output buffer for the logout button
	 * @param $message, String output message
	 * @return  void, BUT writes to standard output!
	 */
	private function generateLoginFormHTML($message) {
		return '
		<form method="post" > 
		<fieldset>
		<legend>Login - enter Username and password</legend>
		<p id="' . self::$messageId . '">' . $message . '</p>
		
		<label for="' . self::$name . '">Username :</label>
		<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->saveUsername() . '" />
		
		<label for="' . self::$password . '">Password :</label>
		<input type="password" id="' . self::$password . '" name="' . self::$password . '" />
		
		<label for="' . self::$keep . '">Keep me logged in  :</label>
		<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
		
		<input type="submit" name="' . self::$login . '" value="login" />
		</fieldset>
		</form>
		';
	}
	
	public function generateRegisterUserLink() : string {
		if($this->lookForGet()) {
			return '<a href="?">Back to login</a>';
		}
		return '<a href="?register">Register a new user</a>';
	}
	
	public function lookForGet() : bool {
		return isset($_GET['register']);
	}
	
	/** 
	 * Validates the username
	 * 
	 * @return bool
	 */
	public function validateUsername() : bool {
		return isset($_POST[self::$name]) && !empty($_POST[self::$name]);
	}
	/**
	 * Validates the password
	 * 
	 * @return bool 
	 */
	public function validatePassword() : bool {
		return isset($_POST[self::$password]) && !empty($_POST[self::$password]);
	}
	public function saveUsername() {
		if(isset($_POST[self::$name])) {
			return $_POST[self::$name];
		} else if(isset($_SESSION['username'])) {
			return $_SESSION['username'];
		}
	}
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	public function getRequestUserName() {
		return $_POST[self::$name];
	}
	public function getRequestPassword() {
		return $_POST[self::$password];
	}
	public function printMessages(){
		$mess = null;
		$arr = $this->exception->loginCheck($this->getRequestUserName(), $this->getRequestPassword(), $this->loginModel->getStatus(), $this->loginModel->checkUsename($this->getRequestUserName()), $this->registerModel->getRegisterStatus());
		foreach($arr as $value) {
			$mess .= $value;
		}
		return $mess;
	}
}	