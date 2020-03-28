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
		return get_object_vars($obj);
	}
}