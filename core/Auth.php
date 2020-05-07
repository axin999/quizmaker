<?php
namespace Core;
use Core\Session;
class Auth{
	public static function check(){
		if(isset($_SESSION['LoggedIn']) && Session::get("LoggedIn") == true) return true;
		return false;
	}
}