<?php
namespace Core;

class HP{
	public static function dnd($data){
		echo "<pre>";
		var_dump($data);
		echo "</pre>";
		die();
	}
	public static function dnl($data){
		echo "<pre>";
		var_dump($data);
		echo "</pre>";
	}
	public static function pr($data){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}

	public static function echonl($data){
		if(is_array($data)){
			echo "<pre>";
			print_r($data);
			echo "</pre>";
		}else{
			echo $data.'<br>';
		}
	}

	public static function currentPage(){
		$currentPage = $_SERVER['REQUEST_URI'];
		if($currentPage == PROJECT_ROOT || $currentPage == PROJECT_ROOT.'home/index'){
			$currentPage = PROJECT_ROOT. 'home';
		}
		return $currentPage;
	}

	public static function getObjectProperties($obj){
		return self::filterProperties(get_object_vars($obj));
	}


	public static function group_by($key,$data) {

	if(array_filter($data,"is_object")){
		$data = json_decode(json_encode($data), true);
	}
		
    $result = array();
    foreach($data as $val) {
        if(array_key_exists($key, $val)){
            $result[$val[$key]][] = $val;
        }else{
            $result[""][] = $val;
        }
    }

    return $result;
	}

// filter variable that is not needed, working with sequential and associative array, but not for multidimensional array
	public static function filterProperties($fields = []){
		$propertiesToFilter = array('created_at','updated_at','lastinsertId');
		foreach ($propertiesToFilter as $key) {
			if(array_key_exists($key, $fields)) return array_diff_key($fields, array_flip($propertiesToFilter));
		}
		
		if(!self::is_multi_array($fields)){
			return array_diff($fields, $propertiesToFilter);
		}else{
			return $fields;
		}
			
	}

	public static function is_multi_array($arr) { 
	    rsort($arr); 
	    return isset($arr[0]) && is_array($arr[0]); 
	} 
}