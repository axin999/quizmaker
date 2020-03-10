<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

// load configuration and helper
require_once(ROOT. DS . 'config' . DS .'config.php');
require_once(ROOT. DS . 'app'. DS . 'libs' . DS . 'helpers' . DS . 'function.php');


//Autoload classes

function autoload($className){
	if(file_exists(ROOT.DS.'core'.DS. $className.'.php')){
		require_once(ROOT. DS . 'core' . DS . $className. '.php');
	}
	else if (file_exists(ROOT. DS . 'app' . DS . 'controllers'. DS . $className. '.php')) {
		require_once(ROOT. DS . 'app' . DS . 'controllers'. DS . $className. '.php');
	}
	else if (file_exists(ROOT. DS . 'app' . DS . 'models'. DS . $className. '.php')) {
		require_once(ROOT. DS . 'app' . DS . 'models'. DS . $className. '.php');
	}
}

spl_autoload_register('autoload');
session_start();

// this will create an array for the path info of the server 
$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];
/*phpinfo();dnd();*/
$db = DB::getInstance();
Router::route($url);
//dnd($url);