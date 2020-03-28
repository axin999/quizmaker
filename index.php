<?php
use Core\Session;
use Core\Cookie;
use Core\Router;
use Core\DB;
use App\Models\Users;
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

// load configuration and helper
require_once(ROOT. DS . 'config' . DS .'config.php');
//require_once(ROOT. DS . 'app'. DS . 'libs' . DS . 'helpers' . DS . 'function.php');


//Autoload classes

function autoload($className){
	$classArray = explode('\\', $className);
	$class = array_pop($classArray);
	$subPath = strtolower(implode(DS, $classArray));
	$path = ROOT. DS . $subPath . DS . $class .'.php';
/*	var_dump($classArray);
	var_dump($class);
	var_dump($subPath);
	var_dump($path);
	exit;*/
	if(file_exists($path)){
		require_once($path);
	}
}
spl_autoload_register('autoload');
session_start();

// this will create an array for the path info of the server 
$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];
/*phpinfo();dnd();*/
if(!Session::exists(CURRENT_USER_SESSION_NAME) && Cookie::exists(REMEMBER_ME_COOKIE_NAME)){
	Users::loginUserFromCookie();
}
$db = DB::getInstance();
Router::route($url);
//dnd($url);
