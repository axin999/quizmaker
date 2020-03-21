<?php
	function dnd($data){
		echo "<pre>";
		var_dump($data);
		echo "</pre>";
		die();
	}
	function dnl($data){
		echo "<pre>";
		var_dump($data);
		echo "</pre>";
	}
	function pr($data){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}

	function echonl($data){
		if(is_array($data)){
			echo "<pre>";
			print_r($data);
			echo "</pre>";
		}else{
			echo $data.'<br>';
		}
	}
	function sanitize($dirty){
		return htmlentities($dirty, ENT_QUOTES, 'UTF-8');
	}

	function currentUser(){
		return Users::currentLoggedInUser();
	}

	function posted_values($post){
		$clean_ary = [];
		foreach ($post as $key => $value) {
			$clean_ary[$key] = sanitize($value);
		}
		return $clean_ary;
	}

	function currentPage(){
		$currentPage = $_SERVER['REQUEST_URI'];
		if($currentPage == PROJECT_ROOT || $currentPage == PROJECT_ROOT.'home/index'){
			$currentPage = PROJECT_ROOT. 'home';
		}
		return $currentPage;
	}