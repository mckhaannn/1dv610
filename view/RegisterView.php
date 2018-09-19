<?php

namespace view;

class RegisterView {
  private static $register = 'RegisterUser::register';
  private static $messageId = 'LoginView::Message';
	private static $regName = 'LoginView::UserName';
	private static $regPassword = 'LoginView::Password';
  

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
		}
		$response = $this->generateRegisterForm($message);
		return $response;
	}


  
  public function generateRegisterForm($message) {
    return '
    <form method="post" > 
      <fieldset>
        <legend>Login - enter Username and password</legend>
        <p id="' . self::$messageId . '">' . $message . '</p>
        <label for="' . self::$regName . '">Username :</label>
					<input type="text" id="' . self::$regName . '" name="' . self::$regName . '" value="" />

					<label for="' . self::$regPassword . '">Password :</label>
          <input type="password" id="' . self::$regPassword . '" name="' . self::$regPassword . '" />
          
					<label for="' . self::$regPassword . '">Repete Password :</label>
					<input type="password" id="' . self::$regPassword . '" name="' . self::$regPassword . '" />
					
					<input type="submit" name="' . self::$register . '" value="register" />
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
		return isset($_POST[self::$regName]) && !empty($_POST[self::$regName]);
	}
	/**
	 * Validates the password
	 * 
	 * @return bool 
	 */
	public function validatePassword() : bool {
		return isset($_POST[self::$regPassword]) && !empty($_POST[self::$regPassword]);
	}

  public function getRequestRegisterUsername() {
		return $_POST[self::$regName];
	}
	public function getRequestRegisterPassword() {
		return $_POST[self::$regPassword];
	}
}