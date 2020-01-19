<?php

class Session{
	
	public static function start(){
		session_start();
	}
	public static function end(){
		session_destroy();
		header("location:login.php");
	}
	public static function set($key, $value){
		$_SESSION[$key] = $value;
	}
	public static function get($key){
		if (isset($_SESSION[$key])) {
			return $_SESSION[$key];
		} else {
			return false;
		}
	}

	public static function check_session(){
		self::start();
		if (self::get("login") == false) {
			self::end();
			header("location:login.php");
		}
	}

	public static function check_login(){
		self::start();
		if (self::get("login") == true) {
			header("location:index.php");
		}
	}
}
?>