<?php
namespace Core;
use Core\Session;
use App\Models\Users;

class Router{
	public static function route($url){
	
		//Controller
		$controller  = (isset($url[0]) && $url[0] != '') ? ucwords($url[0]).'Controller' : DEFAULT_CONTROLLER.'Controller';
		$controller_name = str_replace('Controller', '', $controller);
		array_shift($url);


		//action
		$action  = (isset($url[0]) && $url[0] != '') ? $url[0] . 'Action' : 'indexAction';
		$action_name = (isset($url[0]) && $url[0] !='') ? $url[0] : 'index';
		//echonl($action_name);
		array_shift($url);

		//acl check
		$grantAccess = self::hasAccess($controller_name, $action_name);
		if(!$grantAccess){
			$controller = ACCESS_RESTRICTED.'Controller';
			$controller_name = ACCESS_RESTRICTED;
			$action = 'indexAction';
		}


		//params
		$queryParams = $url;
		$controller = 'App\Controllers\\'.$controller;
		$dispatch = new $controller($controller_name,$action);
		//dnd($dispatch);
		if(method_exists($controller, $action)){
			call_user_func_array([$dispatch,$action], $queryParams);
		}
		else{
			die('method'.$controller_name.' does not exist in the controller');
		}
	}
	public static function redirect($location){
		if(!headers_sent()){
			header('Location: '.PROJECT_ROOT.$location);
			exit;
		}else{
			echo <<< EOT
			<script type="text/javascript">
			window.location.heref="{PROJECT_ROOT}.{$location}"
			</script>
			<noscript>
			<meta http-equi="refresh" content="0;url="{$location}">
			</noscript>

EOT;
			exit;

		}
	}

	public static function hasAccess($controller_name,$action_name = 'index'){

		$acl_file = file_get_contents(ROOT . DS . 'app' . DS . 'acl.json');
		$acl = json_decode($acl_file, true);
		$current_user_acls = ["Guest"];
		$grantAccess = false;

		if(Session::exists(CURRENT_USER_SESSION_NAME)){
			$current_user_acls[] = "LoggedIn";	
			foreach (Users::currentUser()->acls() as $a) {
				$current_user_acls[] = $a;
			}
		}

		foreach ($current_user_acls as $level) {

		 	if(array_key_exists($level, $acl) && array_key_exists($controller_name, $acl[$level])){

		 		if(in_array($action_name, $acl[$level][$controller_name]) || in_array("*", $acl[$level][$controller_name])){
		 			$grantAccess = true;
		 			break;
		 		}
		 	}
		 }
		 // check for the denied controllers.
		 foreach ($current_user_acls as $level) {

		  	$denied = $acl[$level]['denied'];
		  	if(!empty($denied) && array_key_exists($controller_name, $denied) && in_array($action_name, $denied[$controller_name])){
		  		//dnd($action_name);
		  		$grantAccess = false;
		  		break;
		  	}

		  }
		 return $grantAccess;
		//return true; 
		//dnd($current_user_acls);
	}

	public static function getmenu($menu){
		$menuAry = [];
		$menuFile = file_get_contents(ROOT. DS . 'app'. DS . $menu. '.json');
		$acl = json_decode($menuFile, true);

		foreach ($acl as $key => $val) {
			if(is_array($val)){
				$sub = [];
				foreach ($val as $k => $v) {

					if($k == 'separator' && !empty($sub)){
						$sub[$k] = '';
						continue;
					}elseif ($finalVal = self::get_link($v)) {
						
						$sub[$k] = $finalVal;
						//echonl($val);
					}
				}

				if(!empty($sub)){
					$menuAry[$key] = $sub;
				}
			}else{
				if($finalVal = self::get_link($val)){
					
						$menuAry[$key] = $finalVal;

					}
				}
			}
		return $menuAry;
	}

	private static function get_link($val){
		if(preg_match('/https?:\/\//', $val) == 1){
			return $val;
		}else{
			$uAry = explode("/", $val);
			$controller_name = ucwords($uAry[0]);
			$action_name = (isset($uAry[1])) ? $uAry[1] : '';	
			if(self::hasAccess($controller_name, $action_name)){
				return PROJECT_ROOT.$val;
				
			}

			return false;
		}
	}
}