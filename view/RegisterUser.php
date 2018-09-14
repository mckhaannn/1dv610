<?php

class registerUser {
  private static $register = 'RegisterUser::register';
  
  public function generateRegisterForm() {
    return '
    <form method="post" > 
      <fieldset>
        <legend>Login - enter Username and password</legend>
        <label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="" />

					<label for="' . self::$password . '">Password :</label>
          <input type="password" id="' . self::$password . '" name="' . self::$password . '" />
          
					<label for="' . self::$password . '">Repete Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />
					
					<input type="submit" name="' . self::$register . '" value="register" />
      </fieldset>
    </form>
    ';
  }
}