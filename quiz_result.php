<?php
include('config/db_connect.php');
include './includes/autoloader.inc.php';

if(isset($_POST['answers'])){
	
	//$datastr = parse_str($_POST['answers']);
	$data = json_decode($_POST['answers'],true);
	//$data = json_decode(stripslashes($_POST['answers']),true);
	//$data = json_decode($_POST['answers'],true);
	
	//$data = json_decode($_POST['useranswer'],true);
	
	$composite_id = "";

	foreach($data as $question) {

		 	$composite_id .= "(".$question['question_id'].",".$question['answer_id']."),";

		 	if($question === end($data)){
		 	 	 $composite_id .= "(".$question['question_id'].",".$question['answer_id'].")";
		 	 };

	};

	$sql = "SELECT question,answer_id,answer FROM questions AS q
			JOIN answers AS a USING (question_id)
			WHERE (a.question_id,a.answer_id) IN ($composite_id)";
	$query = mysqli_query($conn,$sql);
	$results = mysqli_fetch_all($query,MYSQLI_ASSOC);
	
	
	//echo json_encode($results);
	//echo strcmp($results[0]['answer'], "hypertext Preprocessor");
	for($i = 0; $i < count($data); $i++){
		$quizresult[] = array_diff($data[$i],$results[$i]);
	};
	//print_r($quizresult);
	//$serializechecker = array_map('serialize', $data);
	//print_r($serializechecker);
	$quiz = new Quiz();
	$quiz->computeQuizResult($data,$results);

};






/*
function checkarraymap($a){
	array_column($a, 'question_id');
};*/
//print_r($data);
//print_r($results);
//new = array_map('strtolower',$data);
/*$convertoarray = (array) $data;
$new2 = array_column($data, 'question_id');*/
//var_dump($new);
//print_r($results);

if(!isset($_POST['answers'])){
	//echo $_POST['useranswer'];
	//$mySerial = serialize($_POST['useranswer']);
	$data = json_decode($_POST['useranswer'],true);
	//print_r($data);
	//$data = json_decode($mySerial,true);
	//print_r($data);

	
	$composite_id = "";

	foreach($data as $question) {

		 	$composite_id .= "(".$question['question_id'].",".$question['answer_id']."),";

		 	if($question === end($data)){
		 	 	 $composite_id .= "(".$question['question_id'].",".$question['answer_id'].")";
		 	 };

	};
	//echo "$composite_id";
	$sql = "SELECT question,answer_id,answer FROM questions AS q
			JOIN answers AS a USING (question_id)
			WHERE (a.question_id,a.answer_id) IN ($composite_id)";
	$query = mysqli_query($conn,$sql);
	$results = mysqli_fetch_all($query,MYSQLI_ASSOC);
	
	//print_r($results);
	
	//echo json_encode($results);
	//echo strcmp($results[0]['answer'], "hypertext Preprocessor");
/*	for($i = 0; $i < count($data); $i++){
		$quizresult[] = array_diff($data[$i],$results[$i]);
	};
	print_r($quizresult);*/
	//$serializechecker = array_map('serialize', $data);
	//print_r($serializechecker);
	$quiz = new Quiz();
	$quiz->computeQuizResult($data,$results);

};