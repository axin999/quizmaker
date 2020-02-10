<?php
include('config/db_connect.php');
	$question_id;
	$status = array('success'=>'');
	if(isset($_GET['question_id'])){
		$question_id = $_GET['question_id'];
		$questions = loadQandA($conn,$question_id);
	};

	if (isset($_POST['update'])) {
		$answer_id =$_POST['answer_id'];
		$answer = $_POST['answer'];
		$answer_assoc = array_combine($answer_id,$answer);
		print_r($answer_assoc);
		/*$sql = "UPDATE questions q JOIN answers a
		USING(question_id) 
		SET q.question = 'suckkkkk', a.answer = 'me'
		WHERE question_id = $question_id";
		$query = mysqli_query($conn,$sql);*/

		foreach ($answer_assoc as $answer_id => $answer) {
			$sql =" UPDATE answers 
					SET answer = '$answer' 
					WHERE answer_id = $answer_id AND question_id = $question_id";
					echo $sql;
			$query = mysqli_query($conn,$sql);
		};
		$status['success'] = 'success';
		header("Location:".$_SERVER['PHP_SELF']."?question_id=$question_id");
		loadQandA($conn,$question_id);
	};
function loadQandA($conn,$question_id){
		//$question_id = $_GET['question_id'];

		$sql = "SELECT question,answer_id,answer FROM questions q 
		JOIN answers a 
		USING (question_id)
		WHERE q.question_id = $question_id ";
		$result = mysqli_query($conn,$sql);
		$questions = mysqli_fetch_all($result,MYSQLI_ASSOC);
		mysqli_free_result($result);

		return $questions;
};


	//print_r($questions);
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<?php include("templates/header.php")?>
<body>
	<form action="<?php echo $_SERVER['PHP_SELF']."?question_id=$question_id" ?>" method="POST">
		<h4>Question:</h4>
		<textarea><?php echo htmlspecialchars($questions[0]['question']) ?></textarea>
		<h4>Answers:</h4>
		<?php foreach ($questions as $value) : ?>
			<label for="answer[]">Answer no.<?php echo $i = $i+1?> </label>
			<input type="hidden" name="answer_id[]" value="<?php echo htmlspecialchars($value['answer_id']) ?>" >
			<input id="<?php echo htmlspecialchars($value['answer_id']) ?>" type="textarea" name="answer[]" value="<?php echo $value['answer'] ?>">
		<?php endforeach; ?>
		<input type="submit" name="update" value="update" >
	</form>
	<div class="success"><?php echo htmlspecialchars($status['success']);  ?></div>
</body>

</html>
<?php 
?>