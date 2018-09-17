<?php
namespace view;

// require_once('controller/LoginController.php');


class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';
	

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {
		$message = '';
		
		$response = $this->generateLoginFormHTML($message);
		
		// $loginController = new LoginController();

		// $response .= $this->generateLogoutButtonHTML($message);
		return $response;
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
		<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="" />
		
		<label for="' . self::$password . '">Password :</label>
		<input type="password" id="' . self::$password . '" name="' . self::$password . '" />
		
		<label for="' . self::$keep . '">Keep me logged in  :</label>
		<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
		<input type="submit" name="' . self::$login . '" value="login" />
		</fieldset>
			</form>
			';
	}
		
	public function registerUser() {
		return '<a href="?register">Register a new</a>';
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
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	public function getRequestUserName() {
		return $_POST[self::$name];
	}
	public function getRequestPassword() {
		return $_POST[self::$password];
	}
}

// set up cookies - not completed
// $cookie_name = "user";
// $cooie_value = "John dee";
// setcookie($cookie_name, $cooie_v   bvalue, time() + (86400 * 30), "/");

// if(!isset($_COOKIE[$cookie_name])) {
// 	echo "Cookie named '" . $cookie_name . "' is not set!";
// } else {
// 		echo "Cookie '" . $cookie_name . "' is set!<br>";
// 		echo "Value is: " . $_COOKIE[$cookie_name];
// }