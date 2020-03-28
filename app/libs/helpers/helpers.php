<?php

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