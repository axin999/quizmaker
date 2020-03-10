<?php 
	//connect to DB
	$conn = mysqli_connect('127.0.0.1','engelbert','131313','quiz_maker');
// check connection
	if(!$conn){
		echo 'connection error'. mysqli_connect_error();
	}
