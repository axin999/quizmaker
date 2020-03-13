<?php
class Router{
	public static function route($url){
	
		//Controller
		$controller  = (isset($url[0]) && $url[0] != '') ? ucwords($url[0]) : DEFAULT_CONTROLLER;
		$controller_name = $controller;
		array_shift($url);


		//action
		$action  = (isset($url[0]) && $url[0] != '') ? $url[0] . 'Action' : 'indexAction';
		//$action_name = $controller;
		array_shift($url);


		//params
		$queryParams = $url;

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
	public static function get(){

	}
	public static function post(){
		
	}
}